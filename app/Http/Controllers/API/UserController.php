<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\UpdateUserPasswordRequest;
use App\Http\Requests\API\UpdateUserProfileRequest;
use App\Http\Resources\API\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function userProfile()
    {
        return response()->json(['success' => true, 'message' => 'User Profile', 'data' => new UserResource(Auth::user())]);
    }

    public function updateUserProfile(UpdateUserProfileRequest $request)
    {
        $user = Auth::user();

        if ($request->has('name')) {
            $user->name = $request->input('name');
        }

        if ($request->has('email')) {
            $user->email = $request->input('email');
        }

        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/profile'), $imageName);
            $user->image = url('images/profile/'.$imageName);
        }

        $user->save();

        return response()->json(['success' => true, 'message' => 'User Profile updated successfully', 'data' => new UserResource($user)]);
    }

    public function updateUserPassword(UpdateUserPasswordRequest $request)
    {
        $user = Auth::user();

        if (!Hash::check($request->input('old_password'), $user->password)) {
            return response()->json(['success' => false, 'message' => 'Old password is incorrect', 'data' => []], 401);
        }

        $user->password = Hash::make($request->input('new_password'));
        $user->save();

        return response()->json(['success' => true, 'message' => 'Password updated successfully', 'data' => []]);
    }

    public function userProfileDelete(Request $request)
    {
        Auth::user()->delete();
        return response()->json(['success' => true, 'message' => 'User Deleted', 'data' => []]);
    }
}
