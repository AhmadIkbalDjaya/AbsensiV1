<?php

namespace App\Http\Controllers\MasterData;

use App\Models\Shift;
use App\Models\Employee;
use App\Models\Location;
use App\Models\Position;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Employee::with([
                "position:id,position_name", 
                "location:id,name",
                "shift:id,shift_name",
                ])->get();
        return response()->base_response($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            "position" => Position::select('id', 'position_name')->get(),
            "shift" => Shift::select('id', 'shift_name')->get(),
            "location" => Location::select('id', 'name', 'address')->get(),
        ];
        return response()->base_response($data);
        dd($data);
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
            "nik" => "required|max:255|unique:employees",
            "name" => "required|max:255",
            "email" => "required|email|max:255|unique:employees",
            "password" => "required|min:8|max:255",
            "position_id" => "required|exists:positions,id",
            "shift_id" => "required|exists:shifts,id",
            "location_id" => "required|exists:locations,id",
            "photo" => "image|mimes:jpeg,png,jpg",
        ]);
        if($request->file('photo')){
            $validated["photo"] = $request->file("photo")->store('employess-photo');
        }
        $validated["password"] = Hash::make($validated["password"]);
        $employee = Employee::create($validated);
        return response()->base_response($employee, 200, "OK", "Data Berhasil Ditambahkan");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        $data = $employee->loadMissing([
                "position:id,position_name", 
                "location:id,name",
                "shift:id,shift_name",
        ]);
        return response()->base_response($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $data = [
            "employee" => $employee,
            "position" => Position::select('id', 'position_name')->get(),
            "shift" => Shift::select('id', 'shift_name')->get(),
            "location" => Location::select('id', 'name', 'address')->get(),
        ];
        return response()->base_response($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            "nik" => "required|max:255|unique:employees,nik,$employee->id",
            "name" => "required|max:255",
            // "email" => "required|email|max:255|unique:employees,email,$employee->id",
            // "password" => "required|min:8|max:255",
            "position_id" => "required|exists:positions,id",
            "shift_id" => "required|exists:shifts,id",
            "location_id" => "required|exists:locations,id",
            "photo" => "image|mimes:jpeg,png,jpg",
        ]);

        if($request->file('photo')){
            if($request->oldPhoto && $request->oldPhoto != "employess-photo/default.jpeg"){
                Storage::delete($request->oldPhoto);
            }
            $validated["photo"] = $request->file("photo")->store('employess-photo');
        }
        
        if($request['password']){
            $validated["password"] = Hash::make($request["password"]);
        }
        $employee->update($validated);
        return response()->base_response($employee, 200, "OK", "Data Berhasil Di Update");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return response()->base_response("", 200, "OK", "Data Berhasil Dihapus");
    }
}