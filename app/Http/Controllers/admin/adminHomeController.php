<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\coli;
use Illuminate\Http\Request;
use App\Http\Middleware\user;
// use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class adminHomeController extends Controller
{
    public function index() {
        return view('admin.content.index');
    }

    public function colis() {
        $colis = coli::all();
        return view('admin.content.colis.index',compact('colis'));
    }

    public function view_colis($id) {
        $coli = coli::find($id);
        return view('admin.content.colis.view',compact('coli'));
    }

    public function view_order($id) {
        $order = coli::find($id);
        return view('admin.content.order.un_order',compact('order'));
    }

    public function colis_a_traiter() {
        $colis = coli::all()->where('livreur_id',"!=","Null");
        return view('admin.content.colis.traiter',compact('colis'));
    }

    public function valider_coli(Request $request) {
        $coli = coli::find($request->coli_id);
        $coli->update([
            "admin_id" => auth()->user()->id,
            "statue" => "v_admin",
            "total" => $request->total,
            "admin_at" => Carbon::now()->toRfc850String()
        ]);
        return redirect()->route("admin.colis")->with([
            "success" => "coli est valider"
        ]);
    }

    public function refuse_coli(Request $request) {
        $coli = coli::find($request->coli_id);
        $coli->update([
            "admin_id" => auth()->user()->id,
            "statue" => "r_admin",
            "admin_at" => Carbon::now()->toDateTimeString(),
            "total" => $request->total
        ]);
        return redirect()->route("admin.colis")->with([
            "success" => "coli est refusée"
        ]);
    }

    public function orders_list() {
        $orders = coli::all()->where("statue","!=","nouveau");
        return view('admin.content.order.index',compact('orders'));
    }
}
