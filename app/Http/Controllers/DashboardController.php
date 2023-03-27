<?php

namespace App\Http\Controllers;

use App\Models\Cuty;
use App\Models\Shift;
use App\Models\Employee;
use App\Models\Location;
use App\Models\Position;
use App\Models\Presence;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index () {
        $data = [
            "employe_count" => Employee::count(),
            "position_count" => Position::count(),
            "location_count" => Location::count(),
            "shift_count" => Shift::count(),
            // "presences_today" => Presence::select("id", "time_in", "time_out")->whereDate("presence_date", today())->get(),
            "presences_today" => Presence::join('employees', 'employees.id', '=', 'presences.employee_id')
                                ->select('presences.id', 'employees.name', 'presences.time_in', 'presences.time_out', 'presences.employee_id')
                                ->whereDate('presences.presence_date', today())
                                ->get(),
            // "presences_today" => Presence::select("id", "time_in", "time_out", "employee_id")
            //                     ->with("employee:id,name")
            //                     ->whereDate("presence_date", today())
            //                     ->latest()->limit(10)->get(),
            "cutie request" => Cuty::join("employees", "employees.id", '=', "cuties.employee_id")
                                ->select("cuties.id", "cuties.cuty_start", "cuties.cuty_total", "cuties.date_work", "employees.name")
                                ->where("cuty_status", null)->get(),
        ];
        return response()->base_response($data);
    }
}
