<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginPagesController extends Controller
{
    public function home(){
			return view('auth/login');

		}
}
