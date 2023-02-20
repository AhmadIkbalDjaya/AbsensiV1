<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Location::withCount(['employee'])->get();
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
            "name" => "required",
            "address" => "required",
        ]);
        $location = Location::create($validated);
        return response()->base_response($location, 201, "Created", "Data Berhasil Ditambahkan");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        $data = Location::where('id', $location->id)->withCount('employee')->get();
        return response()->base_response($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    {
        return response()->base_response($location);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Location $location)
    {
        $validated = $request->validate([
            "name" => "required",
            "address" => "required",
        ]);
        $location->update($validated);
        return response()->base_response($validated, 200, "OK", "Data Berhasil Di Update");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        $employee_count = Location::where('id', $location->id)->withCount('employee')->pluck('employee_count')->first();
        if($employee_count != 0){
            return response()->base_response('', 400, 'Not OK', 'Lokasi Digunakan, Data tidak dapat dihapus');
        }
        $location->delete();
        return response()->base_response("", 200, "OK", "Data Berhasil Di Hapus");
    }
}
