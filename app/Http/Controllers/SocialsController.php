<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialsController extends Controller
{
    public function facebook(){
        return Socialite::driver('facebook')->redirect();
    }
    public function redirecthome(){
        //
    }
}
