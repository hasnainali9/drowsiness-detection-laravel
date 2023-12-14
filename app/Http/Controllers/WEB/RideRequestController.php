<?php

namespace App\Http\Controllers\WEB;

use App\DataTables\RideRequestDataTable;
use App\Http\Controllers\Controller;
use App\Models\RideDrownies;
use App\Models\RideRequest;
use App\Models\RideStop;
use Illuminate\Http\Request;
use Twilio\Rest\Client;

class RideRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(RideRequestDataTable $dataTable)
    {
        return $dataTable->render('rideRequest.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('rideRequest.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        RideRequest::create([
            'user_id'=>$request->user_id,
            'source'=>$request->source,
            'source_lat'=>$request->source_lat,
            'source_long'=>$request->source_long,
            'destination'=>$request->destination,
            'destination_lat'=>$request->destination_lat,
            'destination_long'=>$request->destination_long,
        ]);
        return redirect()->back()->with('message', 'Ride Request Created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rideRequest=RideRequest::findorfail($id);
        return view('rideRequest.show',compact('rideRequest'));
    }



    public function trackRideRequest(string $id)
    {
        $id=base64_decode($id);
        $rideRequest=RideRequest::findorfail($id);
        return view('rideRequest.tracking',compact('rideRequest'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $rideRequest=RideRequest::findorfail($id);
        return view('rideRequest.edit',compact('rideRequest'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rideRequest=RideRequest::findorfail($id);
        $rideRequest->update([
            'source'=>$request->source,
            'source_lat'=>$request->source_lat,
            'source_long'=>$request->source_long,
            'destination'=>$request->destination,
            'destination_lat'=>$request->destination_lat,
            'destination_long'=>$request->destination_long,
            'status'=>$request->status,
        ]);
        return redirect()->back()->with('message', 'Ride Request Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rideRequest=RideRequest::findorfail($id);
        if($rideRequest){
            RideDrownies::where('ride_request_id',$id)->delete();
            RideStop::where('ride_request_id',$id)->delete();
            $rideRequest->delete();
            return redirect()->back()->with('message', 'Ride Request Deleted!');
        }
        return redirect()->back()->withErrors(['msg' => 'No Ride Request Found']);
    }













    //Handle Make Call





}
