<?php

namespace App\Http\Controllers\MasterData;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

use App\Models\User;
use App\Models\Shift;
use App\Models\Employee;
use App\Models\Location;
use App\Models\Position;

use App\Http\Resources\EmployeeResource;
use App\Http\Resources\EmployeeEditResource;

class EmployeeController extends Controller
{
    public function updatePassword(Request $request, Employee $employee){
        $validated = $request->validate([
            'password' => 'required',
        ]);
        $validated["password"] = Hash::make($validated["password"]);
        $user = User::where('id', $employee->user_id);
        $user->update($validated);
        return response()->base_response("", 200, "OK", "Password Berhasil Di Update");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = Employee::with([
        //         "user:id,name,email",
        //         "position:id,position_name", 
        //         "location:id,name",
        //         "shift:id,shift_name",
        //         ])->get();
        $employee = Employee::all();
        $data = EmployeeResource::collection($employee->loadMissing([
            "user:id,name,email",
            "position:id,position_name", 
            "location:id,location_name",
            "shift:id,shift_name"
        ]));
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
            "location" => Location::select('id', 'location_name', 'address')->get(),
        ];
        return response()->base_response($data);
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
            "email" => "required|email|max:255|unique:users",
            "password" => "required|min:8|max:255",
            "position_id" => "required|exists:positions,id",
            "shift_id" => "required|exists:shifts,id",
            "location_id" => "required|exists:locations,id",
            "photo" => "image|mimes:jpeg,png,jpg",
        ]);
        if($request->file('photo')){
            $validated["photo"] = $request->file("photo")->store('employess-photo');
        }
        else{
            $validated["photo"] = "employess-photo/default.jpeg";
        }
        $validated["password"] = Hash::make($validated["password"]);
        $user = [
            'name' => $validated["name"],
            'username' => $validated["name"],
            'email' => $validated["email"],
            'password' => $validated["password"],
            'level' => "2",
        ];
        $user = User::create($user);
        $employee = [
            "nik" => $validated["nik"],
            "user_id" => $user->id,
            "position_id" => $validated["position_id"],
            "shift_id" => $validated["shift_id"],
            "location_id" => $validated["location_id"],
            "photo" => $validated["photo"],
        ];
        
        $data = Employee::create($employee);
        return response()->base_response($data, 201, "Created", "successfully saved data");
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
                "user:id,name,username,email",
                "position:id,position_name", 
                "location:id,location_name",
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
            // "employee" => $employee->loadMissing(['user:id,name,username,email']),
            "employee" => new EmployeeEditResource($employee->loadMissing(['user:id,name,email'])),
            "position" => Position::select('id', 'position_name')->get(),
            "shift" => Shift::select('id', 'shift_name')->get(),
            "location" => Location::select('id', 'location_name', 'address')->get(),
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
        // dd($employee->user->id);
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
        }else{
            $validated["photo"] = "employess-photo/default.jpeg";
        }
        
        // if($request['password']){
        //     $validated["password"] = Hash::make($request["password"]);
        // }

        $validatedEmployee = [
            "nik" => $validated["nik"],
            "user_id" => $employee->user->id,
            "position_id" => $validated["position_id"],
            "shift_id" => $validated["shift_id"],
            "location_id" => $validated["location_id"],
            "photo" => $validated["photo"],
        ];
        $validatedUser = [
            'name' => $validated["name"],
            'username' => $validated["name"],
        ];
        $employee->update($validatedEmployee);
        User::where('id', $employee->user->id)->update($validatedUser);
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
        User::where('id', $employee->user->id)->delete();
        return response()->base_response("", 200, "OK", "Data Berhasil Dihapus");
    }
}
