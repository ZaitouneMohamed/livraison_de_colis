<?php

namespace App\Http\Controllers\user;

use App\Models\coli;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\bons\livraison;

class userpanelController extends Controller
{
    public function index(){
        return view('is-admin.content.index');
    }

    public function traiter_colis() {
        $colis = coli::all()->where('statue',"!=","nouveau")
                ->where('statue',"!=","v_admin")
                ->where('statue',"!=","r_admin")
                ->where('statue',"!=","livreé");
        return view('is-admin.content.colis.traiter',compact('colis'));
    }

    public function view_coli ($colis_id) {
        $coli = coli::find($colis_id);
        return view("is-admin.content.colis.view",compact('coli'));
    }

    public function bon_livraison_pdf ($id){
        $colis = coli::all()->where("livraison_id",$id);
        $pdf = Pdf::loadView('pdf.user.bons.livraison',compact('colis'));
        return $pdf->stream('invoice.pdf');
    }

    public function returned_colis() {
        $colis = coli::all()->where('statue',"retournee");
        return view('is-admin.content.colis.returned',compact('colis'));
    }

    public function colis_livree(){
        $colis = coli::all()->where('statue',"livreé");
        return view('is-admin.content.colis.livree',compact('colis'));
    }

    public function ramassage() {
        $colis = coli::all()->where("statue","nouveau");
        $bons = livraison::all()->where("user_id", auth()->user()->id );
        return view('is-admin.content.colis.bon_livraison.index',compact('colis','bons'));
    }

    public function colis_for_ramassage() {
        $colis = coli::all()->where("statue","nouveau");
        return view('is-admin.content.colis.bon_livraison.add_colis',compact('colis'));
    }

    public function colis_list_bons($id) {
        $colis = coli::all()->where('livraison_id',$id);
        $untacked_colis = coli::all()->where('statue','nouveau');
        return view('is-admin.content.colis.bon_livraison.colis',compact('id','colis','untacked_colis'));
    }
    
    public function colis_with_bons(Request $request) {
        livraison::create([
            'user_id' => auth()->user()->id
        ]);
        $bon = DB::table('livraisons')->where('user_id',auth()->user()->id)->latest()->first();
        $updatecolis = $request->coli;
        foreach ( $updatecolis as $id) {
            DB::table('colis')->where("id",$id)->update([
                "livraison_id" => $bon->id,
                "statue" => "ramasser"
            ]);
        }
        return redirect()->route('user.coli.bons.list',$bon->id);
    }
}
