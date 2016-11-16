<?php

namespace App\Http\Controllers\Admin;

use View, Redirect;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class AdminController extends Controller
{
	public function index() {
		$appointments = DB::table("s_appointments")
				// ->leftJoin("s_appointment_services", "s_appointments.id", "=", "s_appointment_services.appointment_id")
				->leftJoin("users AS cus", "s_appointments.customer_id", "=", "cus.id")
				->leftJoin("users AS mech", "s_appointments.mechanic_id", "=", "mech.id")
				->leftJoin("s_statuses", "s_appointments.status_id", "=", "s_statuses.id")
				->leftJoin("c_cars", "s_appointments.car_id", "=", "c_cars.id")
				->select("s_appointments.*", "s_statuses.name AS status_name", "cus.fname AS customer_fname", "cus.lname AS customer_lname", "mech.fname AS mechanic_fname", "mech.lname AS mechanic_lname", "c_cars.car_model AS car_model")
				->get();
		$assigned = DB::table("s_appointments")->where("status_id", 3)->count();
		$unassigned = DB::table("s_appointments")->where("status_id", 1)->count();
		$completed = DB::table("s_appointments")->where("status_id", 6)->count();
		$data = [
			"appointments" => $appointments,
			"assigned" => $assigned,
			"unassigned" => $unassigned,
			"completed" => $completed
		];
		return View::make('admin.dashboard', $data);
	}


	public function RequestDashboard() {

		return View::make('admin.SRDashboard');
	}


}