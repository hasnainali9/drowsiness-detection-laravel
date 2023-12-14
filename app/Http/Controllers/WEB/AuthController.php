<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Http\Requests\WEB\VerifyAuthRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class AuthController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function verify(VerifyAuthRequest $request){
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed
            return redirect()->route('home'); // Redirect to the home page or any other desired route
        }
        // Authentication failed
        return redirect()->back()->withErrors(['Invalid credentials']); // You can customize the error message
    }
}
