<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function __construct(){
        $this->middleware(['guest']);
    }

    public function index(){
        return view('auth.login');
    }

    public function store(Request $request){
        $this->validate($request, [
            'email'=>'required|email',
            'password'=>'required',
        ]);    
       
        // $user = User::where(['email'=>$request->email])->first();
        // if (!$user || !Hash::check($request->password, $user->password)) {
        //     return back()->with('status', 'Invalid login details');
        // } else {
        //     $request->session()->put('user', $user);
        //     return redirect('/');
        // }
        
        if(Auth::attempt($request->only('email', 'password'), $request->remember)) {
            return redirect()->route('admin.dashboard');
        }

        return back()->with('status', 'Invalid login details');
    }
}
