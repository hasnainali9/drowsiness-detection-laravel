<?php

namespace App\Http\Controllers\WEB;

use App\DataTables\SosDataTable;
use App\Http\Controllers\Controller;
use App\Models\Sos;
use Illuminate\Http\Request;

class SOSController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SosDataTable $dataTable)
    {
        return $dataTable->render('sos.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Sos::create([
            'user_id'=>$request->user_id,
            'phone_no'=>$request->phone_no,
            'call'=>$request->call,
            'message'=>$request->message,
        ]);
        return redirect()->back()->with('message', 'SOS Created!');
    }




    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sos=Sos::findorfail($id);
        return view('sos.edit',compact('sos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $sos=Sos::findorfail($id);
        $sos->update([
            'phone_no'=>$request->phone_no,
            'call'=>$request->call?1:0,
            'message'=>$request->message?1:0,
        ]);
        return redirect()->back()->with('message', 'SOS Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sos=Sos::findorfail($id);
        if($sos){
            $sos->delete();
            return redirect()->back()->with('message', 'SOS Deleted!');
        }
        return redirect()->back()->withErrors(['msg' => 'SOS No not Found']);
    }
}
