<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return response()->base_response(Shift::all(), 200, "OK", "Success");
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
        $validated = $request->validate([
            "shift_name" => "required",
            "time_in" => "required|date_format:H:i:s|before:time_out",
            "time_out" => "required|date_format:H:i:s|after:time_in",
        ]);
        $shift = Shift::create($validated);
        return response()->base_response($shift, 200, "OK", "Data Berhasil Ditambahkan");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function show(Shift $shift)
    {
        return response()->base_response($shift);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function edit(Shift $shift)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shift $shift)
    {
        $validated = $request->validate([
            "shift_name" => "required",
            "time_in" => "required|date_format:H:i:s|before:time_out",
            "time_out" => "required|date_format:H:i:s|after:time_in",
        ]);
        $shift->update($validated);
        return response()->base_response($shift, 200, "OK", "Data Berhasil DiUpdate");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shift $shift)
    {
        $shift->delete();
        return response()->base_response("", 200, "OK", "Data Berhasil Di Hapus");
    }
}
