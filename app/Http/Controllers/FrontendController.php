<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function login()
    {
        return view('user.login');
    }
    
    public function home()
    {
        return view('user.home');
    }
}
