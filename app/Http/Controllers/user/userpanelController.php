<?php

namespace App\Http\Controllers\user;

use App\Models\couli;
use App\Models\order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\coli;

// use App\Http\Controllers\user\userpanelController;

class userpanelController extends Controller
{
    public function index(){
        return view('is-admin.content.index');
    }

    public function traiter_colis() {
        $colis = coli::all()->where('statue',"!=","nouveau")->where('statue',"!=","v_admin")->where('statue',"!=","r_admin");
        return view('is-admin.content.colis.traiter',compact('colis'));
    }

    public function view_coli($colis_id) {
        $coli = coli::find($colis_id);
        return view("is-admin.content.colis.view",compact('coli'));
    }

    public function returned_colis() {
        $colis = coli::all()->where('statue',"retournee");
        return view('is-admin.content.colis.returned',compact('colis'));
    }


    public function colis_livree(){
        $colis = coli::all()->where('statue',"livreé");
        return view('is-admin.content.colis.livree',compact('colis'));
    }
}
