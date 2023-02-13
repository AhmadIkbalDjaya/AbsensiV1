<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
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
        $data = Shift::withCount(['employee'])->get();
        return response()->base_response($data, 200, "OK", "Success");
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
        $data = Shift::where('id', $shift->id)->withCount('employee')->get();
        return response()->base_response($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function edit(Shift $shift)
    {
        return response()->base_response($shift);
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
        $employee_count = Shift::where('id', $shift->id)->withCount('employee')->pluck('employee_count')->first();
        if($employee_count != 0){
            return response()->base_response('', 400, 'NOT OK', 'Shift Digunakan, Data tidak dapat dihapus');
        }
        $shift->delete();
        return response()->base_response("", 200, "OK", "Data Berhasil Di Hapus");
    }
}
