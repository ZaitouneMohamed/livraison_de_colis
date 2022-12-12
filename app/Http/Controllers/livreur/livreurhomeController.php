<?php

namespace App\Http\Controllers\livreur;

use Carbon\Carbon;
use App\Models\coli;
use App\Models\couli;
use App\Models\order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class livreurhomeController extends Controller
{
    public function index() {
        return view("livreur.content.index");
    }

    public function colis_list() {
        $orders = coli::all()->where("livreur_id","!=",auth()->user()->id)->where("statue","v_admin");
        return view('livreur.content.colis.index',compact("orders"));
    }

    // public function colis_request() {
    //     $orders = order::all()->where('livreur_id',auth()->user()->id)->where('statue',1);
    //     return view('livreur.content.colis.request',compact('orders'));
    // }

    // public function accepte_colis(Request $request) {
    //     $order = order::find($request->order_id);
    //     $order->update([
    //         "statue" => 2
    //     ]);
    //     return redirect()->route("livreur.home")->with([
    //         "success" => "commande est accepter"
    //     ]);
    // }

    // public function refuse_colis(Request $request) {
    //     $order = order::find($request->order_id);
    //     $order->update([
    //         "statue" => 3,
    //         "livreur_id" => 0
    //     ]);
    //     return redirect()->route("livreur.home")->with([
    //         "error" => "commande est refuser"
    //     ]);
    // }

    public function take_order($id) {
        $coli = coli::find($id);
        $coli->update([
            "statue" => "v_livreur",
            "livreur_id" => auth()->user()->id,
            // "livreur_at" => Carbon::now()->format('Y-m-d H:i:s')
            "livreur_at" => Carbon::now()->toRfc850String()
        ]);
        return redirect()->route("livreur.home")->with([
            "success" => "commande taked succesfly"
        ]);
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

    public function view_order($id) {
        $order = coli::find($id);
        return view('livreur.content.colis.view',compact('order'));
    }

    public function place_now(Request $request) {
        $order = coli::find($request->coli_id);
        $order->update([
            "place_now" => $request->place_now,
        ]);
        return redirect()->route('livreur.view.coli',$order->id);
    }
}
