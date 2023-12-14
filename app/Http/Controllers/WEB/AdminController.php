<?php

namespace App\Http\Controllers\WEB;

use App\DataTables\AdminDataTable;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(AdminDataTable $dataTable)
    {
        return $dataTable->render('admin.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Admin::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password), // Hash the password,
            'super_admin'=>$request->super_admin?1:0
        ]);
        return redirect()->back()->with('message', 'User Added!');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user=Admin::findorfail($id);
        return view('admin.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user=Admin::findorfail($id);
        $user->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'super_admin'=>$request->super_admin?1:0
        ]);
        return redirect()->back()->with('message', 'User Details Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user=Admin::findorfail($id);
        if($user){
            $user->delete();
        }
        return redirect()->back()->with('message', 'User Deleted!');
    }
}
