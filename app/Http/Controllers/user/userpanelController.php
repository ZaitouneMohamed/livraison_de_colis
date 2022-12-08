<?php

namespace App\Http\Controllers\user;

use App\Models\couli;
use App\Models\order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
// use App\Http\Controllers\user\userpanelController;

class userpanelController extends Controller
{
    public function index(){
        return view('is-admin.content.index');
    }

    public function traiter_colis() {
        $colis = order::all()->where('statue',1);
        return view('is-admin.content.colis.traiter',compact('colis'));
    }

    public function view_coli($colis_id) {
        $coli = couli::find($colis_id);
        $order = DB::table('orders')->where('couli_id', $colis_id);
        return view("is-admin.content.colis.view",compact('coli','order'));
    }
}
