<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Shift;
use App\Models\Employee;
use App\Models\Location;
use App\Models\Position;
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
            "name" => "admin",
            "email" => "admin@gmail.com",
            "username" => "admin",
            "password" => bcrypt('admin123'),
        ]);
        Employee::create([
            "nik" => "123",
            "name" => "sukri",
            "email" => "sukri@gmail.com",
            "password" => bcrypt('password'),
            "position_id" => "3",
            "shift_id" => "1",
            "location_id" => "1",
        ]);

        Employee::create([
            "nik" => "456",
            "name" => "ikrar",
            "email" => "ikrar@gmail.com",
            "password" => bcrypt('password'),
            "position_id" => "3",
            "shift_id" => "1",
            "location_id" => "1",
        ]);

        Location::create([
            "name" => "Jakarta Selatan",
            "address" => "Jalan KP Melayu Kecil 5 no. 24, Bukit Duri, Tebet"
        ]);
        Location::create([
            "name" => "Jakarta Timur",
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

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
