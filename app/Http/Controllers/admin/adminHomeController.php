<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\coli;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
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

    public function coli_pdf(Request $request){
        // $pdf = Pdf::loadView('pdf.invoice');
        // return $pdf->download('invoice.pdf');
        dd($request->all());
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
            "active" => 1
        ]);
        return redirect()->route('admin.users.list');
    }
}
