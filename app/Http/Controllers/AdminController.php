<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\AdminResource;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(User::find("id", "1")->get());
        $data = AdminResource::collection(User::all());
        return response()->base_response($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->base_response(UserLevel::all());
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
            "username" => "required|unique:users|max:255",
            "email" => "required|email|unique:users|max:255",
            "password" => "required|min:8|max:255",
            "fullname" => "required|max:255",
            "user_level_id" => "required|exists:user_levels,id",
        ]);
        $validated["password"] = Hash::make($validated["password"]);
        $data = User::create($validated);
        return response()->base_response($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $admin)
    {
        $data = [
            "admin" => new AdminResource($admin),
            "user_level" => UserLevel::select("id", "level_name")->get(),
        ];
        return response()->base_response($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $admin)
    {
        // dd($request->password);
        $validated = $request->validate([
            "fullname" => "required|max:255",
            "username" => "required|max:255|unique:users,username,$admin->id",
            "email" => "required|email|unique:users,email,$admin->id|max:255",
            "password" => "nullable|min:8",
            "user_level_id" => "required|exists:user_levels,id",
        ]);
        if($request->password && $request->password != null){
            $validated["password"] = Hash::make($validated["password"]);
        } else {
            unset($validated["password"]);
        }
        $admin->update($validated);
        return response()->base_response($admin, 200, "OK", "Data Berhasil di Update");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $admin)
    {
        $admin->delete();
        return response()->base_response("", 200, "OK", "Data Berhasil Dihapus");
    }
}
