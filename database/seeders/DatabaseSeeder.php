<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Cuty;
use App\Models\User;
use App\Models\Shift;
use App\Models\SwSite;
use App\Models\Employee;
use App\Models\Location;
use App\Models\Position;
use App\Models\Presence;
use App\Models\UserLevel;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "username" => "admin",
            "email" => "admin@gmail.com",
            "password" => bcrypt('admin123'),
            "fullname" => "Administrator",
            "user_level_id" => 1,
        ]);
        // User::create([
        //     "name" => "sukri",
        //     "email" => "sukri@gmail.com",
        //     "username" => "sukri",
        //     "password" => bcrypt('password'),
        //     "level" => 2,
        // ]);
        // User::create([
        //     "name" => "ikrar",
        //     "email" => "ikrar@gmail.com",
        //     "username" => "ikrar",
        //     "password" => bcrypt('password'),
        //     "level" => 2,
        // ]);
        // User::create([
        //     "name" => "admin2",
        //     "email" => "admin2@gmail.com",
        //     "username" => "admin2",
        //     "password" => bcrypt('admin2123'),
        //     "level" => 1,
        // ]);


        Employee::create([
            "nik" => "123",
            "email" => "sukri@gmail.com",
            "password" => bcrypt('password'),
            "name" => "sukri",
            // "user_id" => "2",
            "position_id" => "3",
            "shift_id" => "1",
            "location_id" => "1",
        ]);
        Employee::create([
            "nik" => "124",
            "email" => "ikrar@gmail.com",
            "password" => bcrypt('password'),
            "name" => "ikrar",
            // "user_id" => "2",
            "position_id" => "2",
            "shift_id" => "1",
            "location_id" => "2",
        ]);

        // Employee::create([
        //     "nik" => "456",
        //     // "name" => "ikrar",
        //     // "email" => "ikrar@gmail.com",
        //     // "password" => bcrypt('password'),
        //     "user_id" => "3",
        //     "position_id" => "3",
        //     "shift_id" => "1",
        //     "location_id" => "1",
        // ]);

        Location::create([
            "location_name" => "Jakarta Selatan",
            "address" => "Jalan KP Melayu Kecil 5 no. 24, Bukit Duri, Tebet"
        ]);
        Location::create([
            "location_name" => "Jakarta Timur",
            "address" => "Jalan Kebaikan",
        ]);

        Position::create([
            "position_name" => "Marketing",
        ]);
        Position::create([
            "position_name" => "Accounting",
        ]);
        Position::create([
            "position_name" => "Staff",
        ]);

        Shift::create([
            "shift_name" => "FULL TIME",
            "time_in" => "09:00:00",
            "time_out" => "16:00:00",
        ]);

        // Cuty
        Cuty::create([
            "employee_id" => 1,
            "cuty_start" => "2023-02-28",
            "cuty_end" => "2023-03-02",
            "date_work" => "2023-03-03",
            "cuty_total" => "3",
            "cuty_description" => "Tes",
            // "cuty_status",
        ]);
        
        Cuty::create([
            "employee_id" => 2,
            "cuty_start" => "2023-03-28",
            "cuty_end" => "2023-04-02",
            "date_work" => "2023-04-03",
            "cuty_total" => "3",
            "cuty_description" => "Tessss",
            "cuty_status" => 1,
        ]);

        // Presence
        Presence::create([
            "employee_id" => 1,
            "presence_date" => "2023-03-01",
            "time_in" => "21:48:19",
            "time_out" => "21:48:19",
            "picture_in" => "2023-03-01-in-1628615958-6",
            "picture_out" => "2023-03-01-out-1628616131-6",
            "present_id" => 1,
            "latitude_longitude_in" => "-4.5585849,105.40680789999999",
            "latitude_longitude_out" => "-4.5585849,105.40680789999999",
        ]);
        Presence::create([
            "employee_id" => 1,
            "presence_date" => "2023-03-02",
            "time_in" => "21:48:19",
            "time_out" => "21:48:19",
            "picture_in" => "2023-03-02-in-1628615958-6",
            "picture_out" => "2023-03-02-out-1628616131-6",
            "present_id" => 1,
            "latitude_longitude_in" => "-4.5585849,105.40680789999999",
            "latitude_longitude_out" => "-4.5585849,105.40680789999999",
        ]);
        Presence::create([
            "employee_id" => 2,
            "presence_date" => "2023-03-02",
            "time_in" => "21:48:19",
            "time_out" => "21:48:19",
            "picture_in" => "2023-03-02-in-1628615958-6",
            "picture_out" => "2023-03-02-out-1628616131-6",
            "present_id" => 1,
            "latitude_longitude_in" => "-4.5585849,105.40680789999999",
            "latitude_longitude_out" => "-4.5585849,105.40680789999999",
        ]);

        UserLevel::create([
            "level_name" => "Administrator",
        ]);
        UserLevel::create([
            "level_name" => "Operator",
        ]);

        SwSite::create([
            "site_url" => "https://absensi.yuscorp.co.id",
            "site_name" => "Absensi Yuscorp",
            "site_company" => "PT Yuscorp",
            "site_manager" => "Sauki",
            "site_director" => "Sukri",
            "site_phone" => "081241386171",
            "site_address" => "Jl Kampung Melayu Kecil 5 no 24",
            "site_description" => "Absensi Yuscorp",
            "site_logo" => "whiteswlogowebpng.png",
            "site_email" => "admin@gmail.com",
            "site_email_domain" => "admin@gmail.com",
        ]);
        
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
