<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        $authOK = Auth::guard('admin')->attempt($credentials, $request->remember);

        if ($authOK) {
            return redirect()->intended(route('admin.dashbord'));
        }
        return redirect()->back()->withInput($request->only('email','remember'));
    }

    public function index(){
        return view('authadmin.login');
    }

    public function __construct()
    {
        $this->middleware('guest:admin');
    }
}
