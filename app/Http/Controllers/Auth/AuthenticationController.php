<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthenticationController extends Controller {
    public function index(){
        return view('Auth.Pages.Login');
    }

    public function showRegistrationForm(){
        return view('Auth.Pages.Registration');
    }
}
