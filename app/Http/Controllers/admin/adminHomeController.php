<?php

namespace App\Http\Controllers\admin;

use App\Models\couli;
use App\Models\order;
use Illuminate\Http\Request;
use App\Http\Middleware\user;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class adminHomeController extends Controller
{
    public function index() {
        return view('admin.content.index');
    }

    public function colis() {
        $colis = couli::all();
        return view('admin.content.colis.index',compact('colis'));
    }

    public function view_colis($id) {
        $coli = couli::find($id);
        $livreur = DB::table('users')->where('role', 2)->get();
        return view('admin.content.colis.view',compact('coli',"livreur"));
    }

    public function valider_coli(Request $request) {
        $coli = couli::find($request->coli_id);
        $coli->update([
            "statue" => 1
        ]);
        order::create([
            "colis_id" => $request->coli_id,
            "livreur_id" => $request->livreur_id,
            "time" => $request->time,
            "total" => $request->total,
            "statue" => 0,
        ]);
        return redirect()->route("admin.colis")->with([
            "success" => "coli est valider"
        ]);
    }

    public function refuse_coli($id) {
        $coli = couli::find($id);
        $coli->update([
            "statue" => 2
        ]);
        return redirect()->route("admin.colis")->with([
            "success" => "coli est refuse"
        ]);
    }
}
