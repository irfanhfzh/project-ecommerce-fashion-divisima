<?php

namespace App\Http\Controllers\auth\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserLogoutController extends Controller
{
    public function store(){
        Auth::logout();

        return redirect()->route('login');
    }
}
