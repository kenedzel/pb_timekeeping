<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\attendanceRequest;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use DB;
use Auth;
use App\Attendance;
use Input;
use Carbon\Carbon;// import carbon
use Session;

class purpleBugTKController extends Controller
{		protected $request;
        
    //
      public function __construct()
      {
          $this->middleware('auth');
      }
      
      public function index()
   	 	{
        $attendance                 = new Attendance;
        $this->data['attendance']   = $attendance->getAttendance();
    	  return view('page.purpleBugTK', $this->data);

    	}

      public function undertimeTry($id)
      {
        $getTime                    = new Attendance;
        $this->data['time_out']     = $getTime->getRequiredTimeOut($id);
        echo '<pre>';
        die(var_dump($this->data));
      }
      public function obtimein()
      {    
        $check_attendance         = new Attendance;
        $this->data['attendance'] = $check_attendance->getLatestatt_id();   

       if(!is_null($this->data['attendance']))
       {
          if($this->data['attendance']->date && Carbon::now()->format('Y-m-d') == $this->data['attendance']->date)
          {        
            \Session::flash('flash_message_error','You have already timed in');
             if(Auth::user()->accesslvl_id != 1)
              {
                  return redirect('/user');
                  die;
              }
              else
              {
                  return redirect('/purpleBugTK');
                  die;
              }               
          }
       }

        $newOB              = new Attendance;
        $newOB->emp_id      = Auth::user()->id;
        $newOB->time_in     = Carbon::now();
        $newOB->time_out    = '00:00:00';
        $newOB->date        = Carbon::today();
        $newOB->status_id   = 4;
        $newOB->save();
        $getID = $newOB->att_id;
        Session::put('atID',$getID); 
        
        if(Auth::user()->accesslvl_id != 1)
        {
            return redirect('/user');
        }
        else
        {
            return redirect('/purpleBugTK');
        }    
      }

    	public function timein(attendanceRequest $request)
    	{  
        $check_attendance         = new Attendance;
        $this->data['attendance'] = $check_attendance->getLatestatt_id();   

       if(!is_null($this->data['attendance']))
       {
          if($this->data['attendance']->date && Carbon::now()->format('Y-m-d') == $this->data['attendance']->date)
          {        
            \Session::flash('flash_message_error','You have already timed in');
             if(Auth::user()->accesslvl_id != 1)
              {
                  return redirect('/user');
                  die;
              }
              else
              {
                  return redirect('/purpleBugTK');
                  die;
              }    
            
          }
       }

    		$newattendance                = new Attendance;
    		$newattendance->emp_id        = Auth::user()->id;
        $newattendance->time_in       = Carbon::now();        
    		$newattendance->time_out      = '00:00:00';
        $newattendance->date          = Carbon::today();    
        $newattendance->save();                 
        $getID                        = $newattendance->att_id;
        Session::put('atID',$getID);   
  
        $getLatestId                  = DB::table('attendance')->where('emp_id', '=', Auth::user()->id)->where('date', '=', Carbon::now()->format('Y-m-d'))->first();      
  
        $required_time_in             = new Attendance;
        $required->data['attendance'] = $required_time_in->getRequiredTimeIn(Auth::user()->id);
        $in->data['attendance']       = $required_time_in->getTimeIn(Auth::user()->id,$getLatestId->att_id);

            
        // $timein->data['attendance'] = $hours_rendered->getTimeIn(Auth::user()->id,$getLatestId->att_id);
        // $timeout->data['attendance'] = $hours_rendered->getTimeOut(Auth::user()->id,$getLatestId->att_id);
        //  $att_time_in = $timein->data['attendance']->time_in;
        // $att_time_out = $timeout->data['attendance']->time_out;

        $req_time_in                  = $required->data['attendance']->time_in;
        $timed_in                     = $in->data['attendance']->time_in;

        $car_req_time_in              = Carbon::parse($req_time_in);
        $car_timed_in                 = Carbon::parse($timed_in);

        //error attendance when history has been cleared
        // foreach ($in->data['attendance'] as $i) 
        // {
        //   $ti = $in->data['attendance']->time_in;
        // }
        ########## TO GET THE MINS LATE ###############
        //$diff = (strtotime($req) - strtotime($ti))/60;
        $mins_diff                    = $car_timed_in->diffInMinutes($car_req_time_in,false);

        if($mins_diff<0)
        {
          $diff     = abs($mins_diff);
          DB::table('attendance')->where('emp_id',Auth::user()->id)->where('att_id',$getID)->update(['mins_late'=> $diff]);
        }
        else
        {
          DB::table('attendance')->where('emp_id',Auth::user()->id)->where('att_id',$getID)->update(['mins_late'=> 0]);
        }
        
        ########## TO GET THE REMARK ###############
        if($timed_in<$req_time_in)
        {
          DB::table('attendance')->where('emp_id',Auth::user()->id)->where('att_id',$getID)->update(['status_id'=> 3]);
        }
        else
        {
          DB::table('attendance')->where('emp_id',Auth::user()->id)->where('att_id',$getID)->update(['status_id'=> 1]);
        }
        

        ###########ACCESS LEVEL REDIRECT############
   		  if(Auth::user()->accesslvl_id != 1)
        {
            return redirect('/user');
        }
        else
        {
            return redirect('/purpleBugTK');
        }  
    	}

      public function timeout(attendanceRequest $request, $id)
      {              
        
      $check_attendance         = new Attendance;
      $this->data['attendance'] = $check_attendance->getLatestatt_id();   
      
      if($this->data['attendance']->time_out != '00:00:00')
             {
                if($this->data['attendance']->date && Carbon::now()->format('Y-m-d') == $this->data['attendance']->date)
                {        
                  \Session::flash('flash_message_error','You have already timed out');
                   if(Auth::user()->accesslvl_id != 1)
                    {
                        return redirect('/user');
                        die;
                    }
                    else
                    {
                        return redirect('/purpleBugTK');
                        die;
                    }    
                  
                }
             }
        // $attend = new Attendance;
        // $values = array (
        //                   'time_out'    => Carbon::now()
        //                 );
        // $attend->updateTimeOut('attendance', 'employee_id', $id, $values);

        //DB::table('attendance')->where('emp_id',$id)->where('att_id',Session::get('atID'))->where('date', '=', Carbon::now()->format('Y-m-d'))->update(['time_out'=> Carbon::now()]); //where last inserted attendance id = itself
        $getLatestId                    = DB::table('attendance')->where('emp_id', '=', Auth::user()->id)->where('date', '=', Carbon::now()->format('Y-m-d'))->first();      
        DB::table('attendance')->where('att_id', '=', $getLatestId->att_id)->update(['time_out'=> Carbon::now()]);
        //delete update clause
        $hours_rendered = new Attendance;
        $timein->data['attendance']     = $hours_rendered->getTimeIn(Auth::user()->id,$getLatestId->att_id);
        $timeout->data['attendance']    = $hours_rendered->getTimeOut(Auth::user()->id,$getLatestId->att_id);

        $att_time_in                    = $timein->data['attendance']->time_in;
        $att_time_out                   = $timeout->data['attendance']->time_out;

        $tmp_TimeIn                     = Carbon::parse($att_time_in);
        $tmp_TimeOut                    = Carbon::parse($att_time_out);

        $computed_hrs                   = $tmp_TimeIn->diffInHours($tmp_TimeOut, false);
        $computed_minues                = $tmp_TimeIn->diffInMinutes($tmp_TimeOut, false);
        //CHECK HOURS RENDERED DEDUCTION - LUNCH TIME
        ////////////////////////////////////////////////////

        $obj                          = new Attendance;
        $out->data['attendance']      = $obj->getTimeOut(Auth::user()->id,$getLatestId->att_id);
        $time_out                     = $out->data['attendance']->time_out;
        $car_time_out                 = Carbon::parse($time_out);

        $required->data['attendance'] = $obj->getRequiredTimeOut(Auth::user()->id);
        $req_time_out                 = $required->data['attendance']->time_out;
        $car_req_time_out             = Carbon::parse($req_time_out);


        $undertime_val                = ($car_time_out->diffInMinutes($car_req_time_out, false))/60;
        // var_dump($req_time_out . '   '.$time_out.  '     '.$undertime_val);die;
        DB::table('attendance')->where('att_id','=',$getLatestId->att_id)->update(['under_time'=>$undertime_val]);
        ////////////////////////////////////////////////////////


         if($att_time_in < '12:00:00' && $att_time_out > '12:00:00')
         {
         $computed_hrs                  = $computed_hrs - 1; 
         //$computed_hrs   = $tmp_TimeIn->diffInHours($tmp_TimeOut, false);
         }
         else if($att_time_in > '12:00:00')
         {
         $computed_hrs                  = $tmp_TimeIn->diffInHours($tmp_TimeOut, false);//$hrs_rendered = ((strtotime($att_time_out) - strtotime($att_time_in))/60)/60; //hours rendered to hours
         }
         DB::table('attendance')->where('emp_id',$id)->where('att_id',$getLatestId->att_id)->update(['hrs_rendered'=> $computed_hrs]);

        if(Auth::user()->accesslvl_id != 1)
        {
            return redirect('/user');
        }
        else
        {
            return redirect('/purpleBugTK');
        }  
             // return $getID;

        //    **REPORT(MONTHLY,DAILY,WEEKLY)
      }
    
        public function diff($id)
      {

             $time                        = new Attendance;   
             $a->data['attendance']       = $time->getTimeIn($id);
             $b->data['attendance']       = $time->getTimeOut($id);
            
             $checkdiff                   = new Attendance;
             $rti->data['attendance']     = $checkdiff->getRequiredTimeIn($id);
             $to->data['attendance']      = $checkdiff->getTimeOut($id);         //*******************n.a

          return $a->data['attendance'];
      }

        public function checktimein($id)
      {
            $required_time_in             = new Attendance;
            $required->data['attendance'] = $required_time_in->getRequiredTimeIn($id);
            $in->data['attendance']       = $required_time_in->getTimeIn($id);


           return $required->data['attendance'];
           
      }

      public function timecheck()
      {

        if(Carbon::now() < '12:00:00')
        {
          return 'true';
        }
        else
        {
          return 'false';
        }
      }

      public function whosIn()
      {
        $timed_in                 = new Attendance;
        $this->data['attendance'] = $timed_in->whosIn();
        //var_dump($this->data);die;
        return view('page.whosin',$this->data);
        //return new blade with this->data;

      }



}
