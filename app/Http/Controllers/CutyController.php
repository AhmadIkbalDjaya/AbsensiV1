<?php

namespace App\Http\Controllers;

use App\Models\Cuty;
use Illuminate\Http\Request;
use App\Http\Resources\CutyRequestResource;

class CutyController extends Controller
{
    public function cutyRequest () {
        $data = Cuty::all();
        $data = CutyRequestResource::collection($data);
        return response()->base_response($data);
    }

    public function cutyAction (Request $request, Cuty $cuty) {
        $validated = $request->validate([
            "cuty_status" => "required|numeric|in:1,2"
        ]);
        $cuty->update($validated);
        return response()->base_response($cuty, 200, "OK", "Data Berhasil Di Update");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cuty  $cuty
     * @return \Illuminate\Http\Response
     */
    public function show(Cuty $cuty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cuty  $cuty
     * @return \Illuminate\Http\Response
     */
    public function edit(Cuty $cuty)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cuty  $cuty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cuty $cuty)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cuty  $cuty
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cuty $cuty)
    {
        //
    }
}
