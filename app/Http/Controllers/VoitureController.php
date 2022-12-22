<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\voiture;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class VoitureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $voiture = voiture::all();
        return response($voiture);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request):JsonResponse
    {
        $todayDate = date('m/d/Y');
        $validator = Validator::make($request->all(),[
            "marque" => "required",
            "model"  => "required",
            "image" => ["required","image","mimes:jpg,png,jpeg,gif,svg","max:2048","dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000"],
            "carburant" => ["required"],
            "circulation" => ["required",'date_format:Y-m-d','after_or_equal:'.$todayDate],
            "immatriculation" => "required",
            "puissance" => ["required", "integer"],
            "type" => "required",
            "nbPorte" => ["required", "integer"],
            "nbPlace" => ["required", "integer"],
            "prix" => ["required", "numeric"],
            "statut" => ["required", "integer", "max_digits:1"]
        ]);
        if($validator->fails()) return response()->json(["error" => $validator->errors()]);

        $path = Storage::putFile('image', $request->image);
        $voiture = voiture::create([
            "image" => $path,
            "marque" => $request->marque,
            "model" => $request->model,
            "carburant" => $request->carburant,
            "circulation" => $request->circulation,
            "immatriculation" => $request->immatriculation,
            "puissance" => $request->puissance,
            "type" => $request->type,
            "nbPorte" => $request->nbPorte,
            "nbPlace" => $request->nbPlace,
            "prix" => $request->prix,
            "statut" => $request->statut,
            "id_agence" => ($request->id_agence !== null) ? $request->id_agence : null
        ]);
        return response()->json(['voiture' => $voiture]);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id):JsonResponse
    {
        $voiture = voiture::find($id);
        return response()->json([
            "voiture" => $voiture
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
        $todayDate = date('m/d/Y');
        $validator =Validator::make($request->all(),[
            "id" => "required",
            "marque" => "required",
            "model"  => "required",
            "image" => ["image","mimes:jpg,png,jpeg,gif,svg","max:2048","dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000"],
            "carburant" => ["required"],
            "circulation" => ["required",'date_format:Y-m-d','after_or_equal:'.$todayDate],
            "immatriculation" => "required",
            "puissance" => ["required", "integer"],
            "type" => "required",
            "nbPorte" => ["required", "integer"],
            "nbPlace" => ["required", "integer"],
            "prix" => ["required", "numeric"],
            "statut" => ["required", "integer", "max_digits:1"]
        ]);
        if($validator->fails()) return response()->json(["error" => $validator->errors()]);
        $voiture = voiture::find($request->id);

        if ($request->image === null){
            $path = $voiture->image;
        }else{
            Storage::delete($voiture->image);
            $path =  Storage::putFile('image', $request->image);
        }

        $voiture->update([
            "image" => $path,
            "marque" => $request->marque,
            "model" => $request->model,
            "carburant" => $request->carburant,
            "circulation" => $request->circulation,
            "immatriculation" => $request->immatriculation,
            "puissance" => $request->puissance,
            "type" => $request->type,
            "nbPorte" => $request->nbPorte,
            "nbPlace" => $request->nbPlace,
            "prix" => $request->prix,
            "statut" => $request->statut,
            "id_agence" => ($request->id_agence !== null) ? $request->id_agence : null
        ]);
        return response()->json([
            'voiture' => $voiture
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
        $voiture = voiture::find($id);
        Storage::delete($voiture->image);
        $voiture->delete();
        return response("La voiture à été supprimé avec succès.");
    }
}
