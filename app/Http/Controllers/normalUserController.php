<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Attendance;
# Import Facade
use DB;
use Auth;
use \Carbon\Carbon;

class normalUserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {

        $attendance                             = new Attendance;
        $this->data['attendance']               = $attendance->getAttendance();
        $this->data['current_attendance']       = DB::table('attendance')->where('emp_id', '=', Auth::user()->id)->where('date', '=', Carbon::now()->format('Y-m-d'))->first();
      //  echo $this->data['current_attendance']->att_id;
    	return view('page.normalUser', $this->data);
    }

    public function latestid()
    {
    	$attendance                    = new Attendance;
    	$this->data['attendance']      = $attendance->getLatestatt_id();
    	return $this->data;
    }
}
