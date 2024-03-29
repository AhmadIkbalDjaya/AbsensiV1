<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthenticationController extends Controller
{
    public function login (Request $request) {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        $user = User::where('username', $request->username)->first();

        if(!$user || !Hash::check($request->password, $user->password)){
            return response()->base_response('', 401, "Unauthorized", "Incorrect username or password");
        }
        $data['access_token'] = $user->createToken('user login')->plainTextToken;
        return response()->base_response($data, 200, "OK", "Login Success");
        // return $user->createToken('user login')->plainTextToken;
    }

    public function logout (Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->base_response('', 200, "OK", "Logout Success");
    }
}
