<?php

namespace App\Http\Controllers\user;

use App\Models\couli;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        $colis = couli::all();
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
        // dd($request->all());
        $request->validate([
            "destination" => "required",
            "phone" => "required",
            "ville" => "required",
            "prix" => "required",
            "adresse" => "required",
            "produit" => "required",
            "note" => "required",
        ]);
        couli::create([
            "user_id" => Auth::user()->id,
            "destination" => $request->destination,
            "telephone" => $request->phone,
            "prix" => $request->prix,
            "ville" => $request->ville,
            "adresse" => $request->adresse,
            "produit" => $request->produit,
            "note" => $request->note,
            "autre" => $request->autre,
            "autre" => 'nothing for now',
            "statue" => 0,
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
        $coli = couli::find($id);
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
        $coli = couli::find($id);
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
        // dd($request->all());
        $coli = couli::find($id);
        $request->validate([
            "destination" => "required",
            "phone" => "required",
            "ville" => "required",
            "prix" => "required",
            "prix" => "required",
            "adresse" => "required",
            "produit" => "required",
            "note" => "required",
        ]);
        $coli->update([
            "user_id" => Auth::user()->id,
            "destination" => $request->destination,
            "telephone" => $request->phone,
            "prix" => $request->prix,
            "ville" => $request->ville,
            "adresse" => $request->adresse,
            "produit" => $request->produit,
            "note" => $request->note,
            "autre" => 'nothing for now',
            "statue" => 0,
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
        couli::find($id)->delete();
        return redirect()->route('colis.index')->with([
            "success" => "colis est bien supprimer"
        ]);
    }
}
