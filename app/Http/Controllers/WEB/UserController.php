<?php

namespace App\Http\Controllers\WEB;

use App\DataTables\UserRideRequestDataTable;
use App\DataTables\UsersDataTable;
use App\DataTables\UserSosDataTable;
use App\Http\Controllers\Controller;
use App\Models\RideDrownies;
use App\Models\RideRequest;
use App\Models\RideStop;
use App\Models\Sos;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password), // Hash the password,
        ]);
        return redirect()->back()->with('message', 'User Created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id,UserRideRequestDataTable $userRideRequestDataTable,UserSosDataTable $userSosDataTable)
    {
        $user=User::findorfail($id);
        return view('users.show', [
            'user'=>$user,
            'userRideRequestDataTable' => $userRideRequestDataTable->customHtml($id),
            'userSosDataTable' => $userSosDataTable->customHtml($id)
        ]);
    }


    public function UserRideRequestList(String $id,UserRideRequestDataTable $userRideRequestDataTable){
        return $userRideRequestDataTable->render('view');
    }

    public function UserSosList(String $id,UserSosDataTable $userSosDataTable){
        return $userSosDataTable->render('view');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user=User::findorfail($id);
        return view('users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user=User::findorfail($id);
        $user->update([
            'name'=>$request->name,
            'email'=>$request->email
        ]);
        return redirect()->back()->with('message', 'User Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user=User::findorfail($id);
        if($user){
            RideRequest::where('user_id',$id)->delete();
            Sos::where('user_id',$id)->delete();
            $user->delete();
            return redirect()->back()->with('message', 'User Deleted!');
        }
        return redirect()->back()->withErrors(['msg' => 'No User Found']);

    }
}
