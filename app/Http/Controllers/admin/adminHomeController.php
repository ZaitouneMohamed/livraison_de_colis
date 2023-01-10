<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\coli;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\bons\livraison;
use App\Models\User;

class adminHomeController extends Controller
{
    public function index() {
        return view('admin.content.index');
    }

    public function colis() {
        $colis = coli::all();
        return view('admin.content.colis.index',compact('colis'));
    }

    public function view_coli($id) {
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

    public function returned_colis() {
        $colis = coli::all()->where("statue","retournee");
        return view('admin.content.colis.returned',compact('colis'));
    }

    public function users_list() {
        $users = User::all()->where('role',0)->where('active',0);
        return view('admin.content.manage_user.index',compact('users'));
    }

    public function valide_user(Request $request) {
        $user = User::find($request->user_id);
        $user->update([
            "active" => 1
        ]);
        return redirect()->route('admin.users.list');
    }

    public function invalide_user(Request $request) {
        $user = User::find($request->user_id);
        $user->update([
            "active" => 0
        ]);
        return redirect()->route('admin.users.list');
    }

    public function bon_livraison_list() {
        $bons = livraison::latest()->paginate(5);
        return view('admin.content.bons.livraison.index',compact('bons'));
    }

    public function view_bon_livraison($id) {
        $colis = coli::all()->where("livraison_id",$id);
        $bon= livraison::find($id);
        $livreurs = user::all()->where('role',2);
        return view('admin.content.bons.livraison.view',compact('colis','bon','livreurs'));
    }

    public function valide_bon_livraison($id) {
        $bon = livraison::find($id);
        $bon->update([
            "admin_id" => auth()->user()->id,
            "admin_at" => Carbon::now()->toRfc850String(),
            "admin_statue" => 1
        ]);
        $colis=coli::where("livraison_id",$id);
        $colis->update([
            "statue" => "valide par admin"
        ]);
        return redirect()->route('admin.bon.livraison.list')->with([
            "success" => "bon est valider"
        ]);
    }

    public function untacked_orders() {
        $bons = livraison::all()->where('livreur_id',Null);
        $livreurs = user::all()->where('role',2);
        return view('admin.content.bons.livraison.untacked',compact('bons','livreurs'));
    }

    public function send_order_request_to_livreur(Request $request) {
        $bon = livraison::find($request->bon_id);
        $bon->update([
            "livreur_id" => $request->livreur_id,
            "livreur_statue" => "have request"
        ]);
        return redirect()->back();
    }

    public function annuler_request($id) {
        livraison::find($id)->update([
            "livreur_id" => null,
            "livreur_statue" => null
        ]);
        return redirect()->back();
    }
}
