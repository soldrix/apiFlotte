<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\models\consommation;
use Illuminate\Support\Facades\Validator;

class ConsommationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $consommation = consommation::all();
        return response($consommation);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request):JsonResponse
    {
        $validator = Validator::make($request->all(),[
            "litre" => ["required","numeric"],
            "montant" => ["required","numeric"]
        ]);
        if ($validator->fails()) return response()->json(["error" => $validator->errors()]);
        $consommation = consommation::create([
            "litre" => $request->litre,
            "montant" => $request->montant,
            "id_voiture" => ($request->id_voiture === null) ? null : $request->id_voiture
        ]);
        return response()->json([
            "consommation" => $consommation
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id):JsonResponse
    {
        $consommation = consommation::find($id);
        return response()->json([
            "consommation" => $consommation
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request):JsonResponse
    {
        $validator = Validator::make($request->all(),[
            "id" => "required",
            "litre" => ["required","numeric"],
            "montant" => ["required","numeric"]
        ]);
        if ($validator->fails()) return response()->json(["error" => $validator->errors()]);
        $consommation = consommation::find($request->id);
        $consommation->update([
            "litre" => $request->litre,
            "montant" => $request->montant,
            "id_voiture" => ($request->id_voiture === null) ? null : $request->id_voiture
        ]);
        return response()->json([
            "consommation" => $request->all()
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
        $consommation = consommation::find($id);
        $consommation->delete();
        return response('La consommation a été supprimé avec succès.');
    }
}