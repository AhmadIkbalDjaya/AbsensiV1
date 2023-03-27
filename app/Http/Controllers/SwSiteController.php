<?php

namespace App\Http\Controllers;

use App\Models\SwSite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SwSiteController extends Controller
{
    public function webSettings () {
        $data = SwSite::select(
            "site_name",
            "site_description",
            "site_phone",
            "site_address",
            "site_email",
            "site_email_domain",
            "site_url",
            "site_logo",
        )->get();
        return response()->base_response($data);
    }

    public function updateWebSettings (Request $request) {
        $validated = $request->validate([
            "site_name" => "required",
            "site_description" => "required",
            "site_phone" => "required",
            "site_address" => "required",
            "site_email" => "required",
            "site_email_domain" => "required",
            "site_url" => "required",
            "site_logo" => "nullable|image",
        ]);
        if($request->site_logo){
            Storage::delete($request->site_logo_old);
            $validated["site_logo"] = $request->file("site_logo")->store("siteLogo");
        }
        SwSite::where("id", 1)->update($validated);
        return response()->base_response("", 200, "OK", "Data Berhasil di Update");
    }
    
    public function editProfile () {
        $data = SwSite::select(
            "site_company",
            "site_director",
            "site_manager",
        )->get();
        return response()->base_response($data);
    }

    public function updateProfile (Request $request) {
        $validated = $request->validate([
            "site_company" => "required",
            "site_director" => "required",
            "site_manager" => "required",
        ]);
        SwSite::where("id", 1)->update($validated);
        return response()->base_response("", 200, "OK", "Data Berhasil di Update");
    }
}
