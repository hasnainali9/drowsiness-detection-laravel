<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\UserRegisterRequest;
use App\Http\Resources\API\UserRegisterResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{
    public function Register(UserRegisterRequest $request){
            $user=User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password), // Hash the password,
            ]);
            return response()->json(['success'=>true,'message'=>'User Creared Successfully',new UserRegisterResource($user)], 200);
    }
}
