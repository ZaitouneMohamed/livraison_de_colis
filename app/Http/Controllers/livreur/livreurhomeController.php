<?php

namespace App\Http\Controllers\livreur;

use Carbon\Carbon;
use App\Models\coli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\order;

class livreurhomeController extends Controller
{
    public function index() {
        return view("livreur.content.index");
    }

    public function colis_list() {
        $orders = coli::all()->where("livreur_id","!=",auth()->user()->id)->where("statue","v_admin");
        return view('livreur.content.colis.index',compact("orders"));
    }

    public function nouveau_order() {
        order::create([]);
        return redirect()->route('livreur.order.list');
    }

    public function order_list() {
        $orders = order::all();
        return view('livreur.content.orders.order_list',compact("orders"));
    }

    public function colis_in_order($id) {
        $order = order::find($id);
        $colis_list  = coli::all()
            ->where("statue","v_admin");
        $colis_taked = coli::all()
            ->where("livreur_id" , auth()->user()->id)
            ->where("order_id" , $id);
        return view('livreur.content.orders.colis_in_order',compact('colis_taked',"colis_list","order"));
    }

    public function take_order($id,Request $request) {
        $coli = coli::find($id);
        $coli->update([
            "statue" => "v_livreur",
            "livreur_id" => auth()->user()->id,
            "livreur_at" => Carbon::now()->toRfc850String(),
            "order_id" => $request->order_id
        ]);
        return redirect()->back();
    }

    public function liv_demarer($id) {
        $order = order::find($id);
        $order->update([
            "statue" => "en cours de livraison"
        ]);
        return redirect()->back();
    }

    public function my_colis() {
        $orders = coli::all()->where('livreur_id',auth()->user()->id);
        return view('livreur.content.colis.my_colis',compact("orders"));
    }

    public function change_action(Request $request) {
        $coli = coli::find($request->coli_id);
        $coli->update([
            
        ]);
        if ($request->statue == "ramasser") {
            $coli->update([
                "statue" => $request->statue,
                "ramasser_at" => Carbon::now()->toRfc850String()
            ]);
        }
        elseif ($request->statue == "emballer") {
            $coli->update([
                "statue" => $request->statue,
                "emballe_at" => Carbon::now()->toRfc850String()
            ]);
        }
        elseif ($request->statue == "en cours de livraison") {
            $coli->update([
                "statue" => $request->statue,
                "encours_at" => Carbon::now()->toRfc850String()
            ]);
        }
        elseif ($request->statue == "livreé") {
            $coli->update([
                "statue" => $request->statue,
                "livrée_at" => Carbon::now()->toRfc850String()
            ]);
        }
        elseif ($request->statue == "retournee") {
            $coli->update([
                "statue" => $request->statue,
                "retourner_at" => Carbon::now()->toRfc850String()
            ]);
        }
        return redirect()->route('livreur.colis');
    }

    public function order_place_now($id,Request $request) {
        $order = order::find($id);
        $order->update([
            "place_now" => $request->city
        ]);
        return redirect()->back();
    }

    public function order_statue($id,Request $request) {
        $order = order::find($id);
        if ($request->statue == "ramasser") {
            $order->update([
                "statue" => $request->statue,
                "ramasser_at" => Carbon::now()->toRfc850String()
            ]);
        }
        elseif ($request->statue == "emballer") {
            $order->update([
                "statue" => $request->statue,
                "emballe_at" => Carbon::now()->toRfc850String()
            ]);
        }
        elseif ($request->statue == "en cours de livraison") {
            $order->update([
                "statue" => $request->statue,
                "encours_at" => Carbon::now()->toRfc850String()
            ]);
        }
        return redirect()->back();
    }

    public function view_order($id) {
        $order = coli::find($id);
        return view('livreur.content.colis.view',compact('order'));
    }

    public function place_now(Request $request) {
        $order = coli::find($request->coli_id);
        $order->update([
            "place_now" => $request->place_now,
        ]);
        return redirect()->route('livreur.colis');
    }
}
