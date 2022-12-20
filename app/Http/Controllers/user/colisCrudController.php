<?php

namespace App\Http\Controllers\user;

use App\Models\couli;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\coli;
use Illuminate\Support\Facades\Auth;

class colisCrudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colis = coli::all()->where('user_id',auth()->user()->id);
        return view('is-admin.content.colis.index',compact('colis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "destinataire" => "required|max:255",
            "phone" => "required|max:255",
            "ville" => "required|max:255",
            "prix" => "required|max:255",
            "adresse" => "required|max:255",
            "products" => "required|max:255",
        ]);
        coli::create([
            "user_id" => Auth::user()->id,
            "destinataire" => strip_tags($request->destinataire),
            "telephone" => $request->phone,
            "prix" => $request->prix,
            "ville" => $request->ville,
            "adresse" => $request->adresse,
            "products" => $request->products,
            "note" => $request->note,
        ]);
        return redirect()->route('colis.index')->with([
            "success" => "colis est bien ajouter"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $coli = coli::find($id);
        return view('is-admin.content.colis.view2',compact('coli'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coli = coli::find($id);
        return view('is-admin.content.colis.update',compact('coli'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $coli = coli::find($id);
        $request->validate([
            "destinataire" => "required|max:255",
            "phone" => "required|max:255",
            "ville" => "required|max:255",
            "prix" => "required|max:255",
            "adresse" => "required|max:255",
            "products" => "required|max:255",
        ]);
        $coli->update([
            "user_id" => Auth::user()->id,
            "destinataire" => $request->destinataire,
            "telephone" => $request->phone,
            "prix" => $request->prix,
            "ville" => $request->ville,
            "adresse" => $request->adresse,
            "products" => $request->products,
            "note" => $request->note,
            "statue" =>"nouveau"
        ]);
        return redirect()->route('colis.index')->with([
            "success" => "colis est bien modifier"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        coli::find($id)->delete();
        return redirect()->route('colis.index')->with([
            "success" => "colis est bien supprimer"
        ]);
    }
}
