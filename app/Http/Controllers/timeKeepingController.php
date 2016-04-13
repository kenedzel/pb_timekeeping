<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Users;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class timeKeepingController extends Controller
{
    //
    var $data = array();


    	public function __construct()
    	{
    	    $this->middleware('auth');
    	}
    
        public function index()
	    {
	    	$user 					= new Users;
	    	$this->data['users']	= $user->getUsersnopaginate();
	    	return view('page.timeKeeping',$this->data);
	    }


}
