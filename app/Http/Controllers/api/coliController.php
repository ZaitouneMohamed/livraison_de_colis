<?php

namespace App\Http\Controllers\api;

use App\Models\coli;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\coliResource;

class coliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colis = coli::latest()->get();
        return coliResource::collection($colis);
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
            "user_id" => 1,
            "destinataire" => $request->destinataire,
            "telephone" => $request->phone,
            "prix" => $request->prix,
            "ville" => $request->ville,
            "adresse" => $request->adresse,
            "products" => $request->products,
            "note" => $request->note,
        ]);
        return response()->json("colis est bien ajouter");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
