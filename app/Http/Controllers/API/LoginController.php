<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\UserLoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function Login(UserLoginRequest $request)
    {
        $user = User::where("email",$request->email)->first();

        if ( $user && Hash::check($request->password,$user->password)) {
            $token = $user->createToken('AccessToken')->accessToken;

            return response()->json([
                'success' => true,
                'message' => 'Login Successfully',
                'data' => [
                    'access_token' => $token,
                    'user' => $user,
                ],
            ], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'Login failed'], 401);
        }
    }
}
