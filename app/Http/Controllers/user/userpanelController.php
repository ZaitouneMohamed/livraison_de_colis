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
        $colis = coli::all()->where('statue',"!=","nouveau");
        return view('is-admin.content.colis.traiter',compact('colis'));
    }

    public function view_coli($colis_id) {
        $coli = coli::find($colis_id);
        return view("is-admin.content.colis.view",compact('coli'));
    }

    public function returned_colis() {
        $colis = couli::where('statue',2)->get();
        return view('is-admin.content.colis.returned',compact('colis'));
    }
}
