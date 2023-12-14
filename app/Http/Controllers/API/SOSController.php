<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\SOSCreateRequest;
use App\Http\Requests\API\SOSUpdateRequest;
use App\Http\Resources\API\SOSResource;
use App\Models\Sos;
use Illuminate\Support\Facades\Auth;

class SOSController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            return response()->json(['success'=>true,'message'=>'SOS List','data'=>SOSResource::collection(Auth::user()->sosList()->get())]);
    }

    /**
     * Show the form for creating a new resource.
     */
//    public function create()
//    {
//        //
//    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SOSCreateRequest $request)
    {
        Sos::create([
            'user_id'=>Auth::user()->id,
            'phone_no'=>$request->phone_no,
            'call'=>$request->call,
            'message'=>$request->message,
        ]);
        return response()->json(['success'=>true,'message'=>'SOS Created','data'=>SOSResource::collection(Auth::user()->sosList()->get())]);
    }

    /**
     * Display the specified resource.
     */
//    public function show(string $id)
//    {
//        //
//    }

    /**
     * Show the form for editing the specified resource.
     */
//    public function edit(string $id)
//    {
//        //
//    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SOSUpdateRequest $request, string $id)
    {
        $sos=Sos::where('id',$id)->where('user_id',Auth::user()->id)->first();
        if(!empty($sos)){
            Sos::where('id',$id)->update([
                'phone_no'=>$request->phone_no,
                'call'=>$request->call,
                'message'=>$request->message,
            ]);
            return response()->json(['success'=>true,'message'=>'SOS Updated','data'=>SOSResource::collection(Auth::user()->sosList()->get())]);
        }
        return response()->json(['success'=>false,'message'=>'Un authorized Access','data'=>[]]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sos=Sos::where('id',$id)->where('user_id',Auth::user()->id)->first();
        if(!empty($sos)) {
            Sos::where('id',$id)->where('user_id',Auth::user()->id)->delete();
            return response()->json(['success'=>true,'message'=>'SOS Deleted','data'=>SOSResource::collection(Auth::user()->sosList()->get())]);
        }
        return response()->json(['success'=>false,'message'=>'Un authorized Access','data'=>[]]);

    }
}
