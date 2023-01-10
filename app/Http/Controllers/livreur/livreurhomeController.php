<?php

namespace App\Http\Controllers\livreur;

use Carbon\Carbon;
use App\Models\coli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\bons\livraison;
use App\Models\order;

class livreurhomeController extends Controller
{
    public function index() {
        return view("livreur.content.index");
    }

    public function colis_list() {
        $bons = livraison::all()->where("livreur_id","!=",auth()->user()->id)->where("admin_statue",1);
        return view('livreur.content.colis.index',compact("bons"));
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

    // public function take_order($id,Request $request) {
    //     $coli = coli::find($id);
    //     $coli->update([
    //         "statue" => "v_livreur",
    //         "livreur_id" => auth()->user()->id,
    //         "livreur_at" => Carbon::now()->toRfc850String(),
    //         "order_id" => $request->order_id
    //     ]);
    //     return redirect()->back();
    // }

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

    public function accepte_request($id) {
        $bon = livraison::find($id);
        $bon->update([
            "livreur_statue" => "tacked",
            "livreur_at" => Carbon::now()->toRfc850String()
        ]);
        coli::where('livraison_id',$id)->update([
            "statue" => "tacked by livreur"
        ]);
        return redirect()->back();
    }

    public function my_orders() {
        $orders = livraison::all()->where('livreur_id',auth()->user()->id)->where('livreur_statue','tacked');
        return view('livreur.content.colis.my_orders',compact('orders'));
    }

    public function refuse_request($id) {
        $bon = livraison::find($id);
        $bon->update([
            "livreur_statue" => null,
            "livreur_id" => null,
            "livreur_statue" => null
        ]);
        return redirect()->back();
    }

    public function order_request() {
        $bons = livraison::all()->where('livreur_id',auth()->user()->id)->where('livreur_statue','have request');
        return view('livreur.content.orders.request',compact('bons'));
    }

    public function view_colis_of_bon(Request $request) {
        $bon_id =$request->bon_id; 
        $colis = coli::all()->where('livraison_id',$bon_id);
        $bon = livraison::find($bon_id);
        return view('livreur.content.orders.view_colis',compact('colis','bon_id','bon'));
    }

    public function new_orders() {
        $orders = livraison::all()->where('admin_statue',1)->where('livreur_id',null);
        return view('livreur.content.colis.new_orders',compact('orders'));
    }

    public function take_order($id) {
        livraison::find($id)->update([
            "livreur_id" => auth()->user()->id,
            "livreur_statue" => "tacked"
        ]);
        return redirect()->route('livreur.my_orders.list');
    }

    public function demarer($id) {
        $bon = livraison::find($id);
        $bon->update([
            "livreur_statue" => "on road"
        ]);
        // $coli_id = $bon-
        return redirect()->back();
    }
}
