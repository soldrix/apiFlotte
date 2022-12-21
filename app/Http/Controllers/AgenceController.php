<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\agence;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class AgenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index():JsonResponse
    {
        $agence = agence::all();
        return response()->json([
            'data' => $agence
        ]);
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
            "ville" => "required",
            "rue" => "required"
        ]);
        if ($validator->fails()) return response()->json(["error" => $validator->errors()]);
        $agence = agence::create([
            "ville" => $request->ville,
            "rue" => $request->rue
        ]);
        return response()->json($agence);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id):JsonResponse
    {
        $agence = agence::find($id);
        return response()->json($agence);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request):JsonResponse
    {
        $validator = Validator::make($request->all(),[
            "ville" => "required",
            "rue" => "required"
        ]);
        if ($validator->fails()) return response()->json(['error' => $validator->errors()]);
        $agence = agence::find($request->id);
        $agence->update($request->all());
        return response()->json(["agance" => $request->all()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $agence = agence::find($id);
        $agence->delete();
        return response("L'agence à été supprimé avec succès.");
    }
}
