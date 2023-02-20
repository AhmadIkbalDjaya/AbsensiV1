<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Position::withCount(['employee'])->get();
        return response()->base_response($data);
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
            "position_name" => "required",
        ]);

        $position = Position::create($validated);

        return response()->base_response($position, 201, "Created", "Data Berhasil Ditambahkan");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function show(Position $position)
    {
        $data = Position::where("id", $position->id)->withCount('employee')->get();
        return response()->base_response($data);
        // return response()->base_response($position);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function edit(Position $position)
    {
        return response()->base_response($position);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Position $position)
    {
        $validated = $request->validate([
            "position_name" => "required"
        ]);
        $position->update($validated);
        return response()->base_response($position, 200, "OK", "Data Berhasil Di Update");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function destroy(Position $position)
    {
        $employee_count = Position::where('id', $position->id)->withCount('employee')->pluck('employee_count')->first();
        if($employee_count != 0){
            return response()->base_response('', 400, 'NOt OK', 'Jabatan Digunakan, Data tidak dapat dihapus');
        }
        $position->delete();
        return response()->base_response("", 200, "OK", "Data Berhasil Dihapus");
    }
}
