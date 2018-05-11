<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use Auth;

class LoginPagesController extends Controller
{
	
    public function home(){
    	$topics = $topics->withOrder('recent')->paginate(5);
		return view('static_pages.home',compact('topics'));
    }

    public function homePage(Topic $topics){
    	$topics = $topics->withOrder('recent')->paginate(5);
		return view('static_pages.home',compact('topics'));
    }

}
