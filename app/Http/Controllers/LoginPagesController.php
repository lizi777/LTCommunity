<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class LoginPagesController extends Controller
{
    
    public function home(){
	    if(Auth::check()){
	    	return redirect(route('topics.index'));
	    }
		return view('sessions.create');
    }

    public function homePage(){
	    if(Auth::check()){
	    	return redirect(route('topics.index'));
	    }
		return view('sessions.create');
    }
}
