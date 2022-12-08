<?php

namespace App\Http\Controllers\livreur;

use App\Models\couli;
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
        $colis = order::all()->where("livreur_id","!=",auth()->user()->id)->where("statue",1);
        return view('livreur.content.colis.index',compact("colis"));
    }

    public function colis_request() {
        $orders = order::all()->where('livreur_id',auth()->user()->id)->where('statue',0);
        return view('livreur.content.colis.request',compact('orders'));
    }

    public function accepte_colis(Request $request) {
        $order = order::find($request->order_id);
        $order->update([
            "statue" => 1
        ]);
        return redirect()->route("livreur.home")->with([
            "success" => "commande est accepter"
        ]);
    }

    public function refuse_colis(Request $request) {
        $order = order::find($request->order_id);
        $order->update([
            "statue" => 0,
            "livreur_id" => null
        ]);
        return redirect()->route("livreur.home")->with([
            "error" => "commande est refuser"
        ]);
    }

    public function my_colis() {
        $orders = order::all()->where('livreur_id',auth()->user()->id)->where('statue','!=',0);
        return view('livreur.content.colis.my_colis',compact("orders"));
    }

    public function view_order($id) {
        $coli = order::find($id);
        return view('livreur.content.colis.view',compact('coli'));
    }

    public function place_now(Request $request) {
        $order = order::find($request->coli_id);
        $order->update([
            "place_now" => $request->place_now
        ]);
        return redirect()->route('livreur.view.coli',$order->id);
    }
}
