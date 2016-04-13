<?php
namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
use Auth;
use Session;
use Carbon\Carbon;
class Attendance extends Model
{
    //
    protected $primaryKey = 'att_id';
    protected $table = 'attendance';

    public function getAttendance()
    {
    		$data       =    DB::table('attendance');
            if(Auth::user()->accesslvl_id != 1)
            {
                $data   =    $data->where('emp_id',Auth::user()->id);
                //check userlevel
            }

            $data       =    $data->leftJoin('users', 'attendance.emp_id', '=', 'users.id');
            $data       =    $data->leftJoin('status','attendance.status_id','=','status.stat_id');
            $data       =    $data->select(array('users.*', 'attendance.*','status.stat_name'));
            $data       =    $data->orderBy('att_id','desc');
            $data       =    $data->paginate(20); //record per page *************paginate wont work
  
            return $data;
            
    }

    public function getTimeIn($id,$latest)
    {
            $data       =   DB::table('attendance')->select(array('time_in'))->where('emp_id',$id)->where('att_id',$latest)->first(); 
            return $data;
    }
    public function getTimeOut($id,$latest)
    {
            $data       =   DB::table('attendance')->select(array('time_out'))->where('emp_id',$id)->where('att_id',$latest)->first();
            return $data;
    }
    public function getRequiredTimeIn($id)
    {
            $data       =   DB::table('users')
                            ->leftJoin('schedule','users.sched_id','=','schedule.id')
                            ->select(array('schedule.time_in'))
                            ->where('users.id','=',$id);
           // $data=DB::table('users')->select('req_time_in')->where('id',$id)->get();
            return $data->first();
    }
    public function getRequiredTimeOut($id)
    {
        $data           =   DB::table('users')
                            ->leftJoin('schedule','users.sched_id','=','schedule.id')
                            ->select(array('schedule.time_out'))
                            ->where('users.id','=',$id);
        return $data->first();
    }

    public function getUserHistory($id)
    {
            $data       =   DB::table('attendance')
                            ->leftJoin('users','attendance.emp_id','=','users.id')
                            ->leftJoin('status','attendance.status_id','=','status.stat_id')
                            ->select(array('users.*', 'attendance.*','status.*'))
                            ->where('emp_id',$id)
                            ->orderBy('att_id','desc')
                            ->get();
            return $data;
    }
    public function getallRecord()
    {
            $data       =   DB::table('attendance')
                            ->leftJoin('users','attendance.emp_id','=','users.id')
                            ->leftJoin('status','attendance.status_id','=','status.stat_id')
                            ->select((array('users.fname','users.mname','users.sname','attendance.*','status.*')))
                            ->orderBy('att_id','desc')
                            ->get();
            return $data;
    }
    public function getLatestatt_id()
    {

            $data       =   DB::table('attendance')
                            ->where('emp_id', '=', Auth::user()->id)
                            ->where('date', '=', Carbon::now()->format('Y-m-d'));
                   // ->first();
            return $data->first();
    }
    public function extractMonth($from,$to,$status)
    {

            $data           =   DB::table('attendance');
            $data           =   $data->leftJoin('users','attendance.emp_id','=','users.id');
            $data           =   $data->leftJoin('status','attendance.status_id','=','status.stat_id');
        if($status > 0)
        {
            $data           =   $data->where('attendance.status_id','=',$status);
        }

            $data           =   $data->whereBetween('date',[$from,$to]);
            $data           =   $data->orderBy('att_id','desc')->get();

        // $data           =   DB::table('attendance')
        //                     ->leftJoin('users','attendance.emp_id','=','users.id')
        //                     ->leftJoin('status','attendance.status_id','=','status.stat_id')

        //                     ->whereBetween('date',[$from,$to])
        //                     ->orderBy('att_id','desc')
        //                     ->get();
        // die(var_dump($data));
        return $data;
    }

    ///////////////////////////
    public function extractIndividual($id = 0, $from, $to, $status = 0)
    {    
        $data           =   DB::table('attendance');
        $data           =   $data->leftJoin('users','attendance.emp_id','=','users.id');
        $data           =   $data->leftJoin('status','attendance.status_id','=','status.stat_id');
    if($status > 0)
    {
        $data           =   $data->where('attendance.status_id','=',$status);
    }
        $data           =   $data->where('users.id','=',$id);
        $data           =   $data->whereBetween('date',[$from,$to]);
        $data           =   $data->orderBy('att_id','desc');
        $data           =   $data->get();

        return $data;
    }
    public function whosIn()
    {
        $data           =   DB::table('attendance')
                            ->leftJoin('users','attendance.emp_id','=','users.id')
                            ->leftJoin('status','attendance.status_id','=','status.stat_id')
                            ->where('attendance.date',Carbon::now()->format('Y-m-d'))
                            ->get();

        return $data;
    }
    public function filterbyStatus($status)//$choice
    {
        $data           =   DB::table('attendance')
                            ->leftJoin('users','attendance.emp_id','=','users.id')
                            ->leftJoin('status','attendance.status_id','=','status.stat_id')
                            ->where('attendance.status_id','=',$status)
                            ->orderBy('att_id','desc')
                            ->get();
        return $data;
    }
    public function allStatus()
    {
        $data           =   DB::table('attendance')
                            ->leftJoin('users','attendance.emp_id','=','users.id')
                            ->leftJoin('status','attendance.status_id','=','status.stat_id')
                            ->get();
        return $data;
    }
    public function manualAdd($id, $time_in, $time_out)
    {
        DB::table('attendance')
        ->insert([
                'emp_id'=>$id,
                'time_in'=>$time_in,
                'time_out'=>$time_out,
                'date'=>Carbon::today()
                ]);  
    }
    public function countMinsLate($id)
    {
        $data           =   DB::table('attendance')
                            ->where('emp_id',$id)
                            ->sum('mins_late');
        return $data;
    }
    public function countMinsLateFilter($id, $from, $to)
    {
        $data           =   DB::table('attendance')
                            ->where('emp_id',$id)
                            ->whereBetween('date',[$from,$to])
                            ->sum('mins_late');
        return $data;
    }
    public function countHrsRendered($id)
    {
        $data           =   DB::table('attendance')
                            ->where('emp_id',$id)
                            ->sum('hrs_rendered');
        return $data;
    }
    public function countHrsRenderedFilter($id, $from, $to)
    {
        $data           =   DB::table('attendance')
                            ->where('emp_id', $id)
                            ->whereBetween('date',[$from,$to])
                            ->sum('hrs_rendered');
        return $data;
    }
     public function countUnderTime($id)
    {
        $data           =   DB::table('attendance')
                            ->where('emp_id',$id)
                            ->sum('under_time');
        return $data;
    }
    public function countMinsUnderTimeFilter($id, $from, $to)
    {
        $data           =   DB::table('attendance')
                            ->where('emp_id',$id)
                            ->whereBetween('date',[$from,$to])
                            ->sum('under_time');
        return $data;
    }
    #########################################
    # Dummy methods
    #########################################

    // public function updateTimeOut($table = '', $idCol = '', $id = 0, $field_values = array())
    // {
    //     DB::table($table)->where($idCol, '=', $id)->update($field_values);
    // }

}
