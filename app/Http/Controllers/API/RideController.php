<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\CreateRideRequest;
use App\Http\Resources\API\RideRequestResource;
use App\Models\RideDrownies;
use App\Models\RideRequest;
use App\Models\RideStop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Infobip\Api\SendSmsApi;
use Infobip\Configuration;
use Infobip\Model\SmsTextualMessage;
use Mockery\Exception;
use Twilio\Rest\Client;

class RideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pendingRides=Auth::user()->pendingRideRequests()->first();
        $UserPendingRides=[];
        if(!empty($pendingRides)){
            $UserPendingRides=new RideRequestResource($pendingRides);
        }

        return response()->json(['success'=>true,'message'=>'Ride Request List','pending_ride'=>$UserPendingRides, 'data'=>RideRequestResource::collection(Auth::user()->rideRequestList()->get())]);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRideRequest $request)
    {
        $RideRequest=RideRequest::create([
            'user_id'=>Auth::user()->id,
            'source'=>$request->source,
            'source_lat'=>$request->source_lat,
            'source_long'=>$request->source_long,
            'destination'=>$request->destination,
            'destination_lat'=>$request->destination_lat,
            'destination_long'=>$request->destination_long,
        ]);
        return response()->json(['success'=>true,'message'=>'Ride Request Created','data'=>new RideRequestResource($RideRequest)]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $RideRequest=RideRequest::where('id',$id)->where('user_id',Auth::user()->id)->first();
        if(!empty($RideRequest)){
            return response()->json(['success'=>true,'message'=>'Ride Request List','data'=>new RideRequestResource($RideRequest)]);
        }
        return response()->json(['success'=>false,'message'=>'Un authorized Access','data'=>[]]);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $RideRequest=RideRequest::where('id',$id)->where('user_id',Auth::user()->id)->first();
        if(!empty($RideRequest)){
            RideRequest::where('id',$id)->where('user_id',Auth::user()->id)->update([
                'source'=>$request->source,
                'source_lat'=>$request->source_lat,
                'source_long'=>$request->source_long,
                'destination'=>$request->destination,
                'destination_lat'=>$request->destination_lat,
                'destination_long'=>$request->destination_long,
                'status'=>$request->status
            ]);
            $RideRequest=RideRequest::where('id',$id)->where('user_id',Auth::user()->id)->first();
            return response()->json(['success'=>true,'message'=>'Ride Request Updated','data'=>new RideRequestResource($RideRequest)]);
        }
        return response()->json(['success'=>false,'message'=>'Un authorized Access','data'=>[]]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $RideRequest=RideRequest::where('id',$id)->where('user_id',Auth::user()->id)->first();
        if(!empty($RideRequest)) {
            RideDrownies::where('ride_request_id',$id)->delete();
            RideStop::where('ride_request_id',$id)->delete();
            RideRequest::where('id',$id)->where('user_id',Auth::user()->id)->delete();
            return response()->json(['success'=>true,'message'=>'Ride Request List','data'=>RideRequestResource::collection(Auth::user()->rideRequestList()->get())]);
        }
        return response()->json(['success'=>false,'message'=>'Un authorized Access','data'=>[]]);
    }



    /**
     * Used When Drownies Detected.
     */
    public function DetectDrownies(Request $request)
    {
        $temp=RideDrownies::create([
            'ride_request_id'=>$request->ride_request_id,
            'place'=>$request->place,
            'place_lat'=>$request->place_lat,
            'place_long'=>$request->place_long,
            'image' => $request->image,
            'video' => $request->video,
        ]);
        $rideDrownies=RideDrownies::where('id',$temp->id)->first();

        $sosList=$rideDrownies->rideRequest->user->sosList()->get();
        foreach ($sosList as $key=>$sos){
            if($sos->call){
                $this->makeCall($sos->phone_no,$rideDrownies->id);
            }

            if($sos->message){
                $DriverName=$rideDrownies->rideRequest->user->name;
                $source=$rideDrownies->rideRequest->source;
                $destination=$rideDrownies->rideRequest->destination;
                $message='Hello, this is a Automated Message From Drowsiness detection System. You are recieving this message because '.$DriverName.' has added you as Emergency Contact. This is to Notify you that '.$DriverName.' is feeling drowsy while traveling towards '.$destination.' from '.$source.' Last Drowsiness Detected at '.$request->place.'. You can track the ride by visiting this url '.url('/track/ride-requests/'.base64_encode($request->ride_request_id));
                $this->sendSMS($sos->phone_no,$message);
            }
        }


        return response()->json(['success'=>true,'message'=>'Ride Drowny Created','data'=>[]]);
    }




//Twillio
//    public function sendSMS($number, $message)
//    {
//        $to = $number;
//        $twilioSID = config('twillio.sid');
//        $twilioAuthToken = config('twillio.auth_token');
//        $twilioPhoneNumber = config('twillio.phone_number');
//
//        try {
//            $twilio = new Client($twilioSID, $twilioAuthToken);
//
//            $twilio->messages->create(
//                $to,
//                [
//                    'from' => $twilioPhoneNumber,
//                    'body' => $message,
//                ]
//            );
//
//            return true;
//        } catch (Exception $exception) {
//            return false;
//        }
//    }


//twillio
//    public function makeCall($number,$id)
//    {
//        $to=$number;
//        $twilioSID = config('twillio.sid');
//        $twilioAuthToken = config('twillio.auth_token');
//        $twilioPhoneNumber = config('twillio.phone_number');
//        try {
//            $twilio = new Client($twilioSID, $twilioAuthToken);
//
//            $twilio->calls->create(
//                $to,
//                $twilioPhoneNumber,
//                [
//                    'url' => url('/twilio/'.$id.'/voice/call'), // URL to TwiML file for handling the call
//                ]
//            );
//
//            return true;
//        }catch (Exception $exception){
//            return false;
//        }
//    }



//infobip
    public function sendSMS($number, $message)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://rgvw41.api.infobip.com/sms/2/text/advanced',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{"messages":[{"destinations":[{"to":"'.$number.'"}],"from":"DrowsyDetection","text":"'.$message.'"}]}',
            CURLOPT_HTTPHEADER => array(
                'Authorization: App c1feb0f8039222434ce5d16d30f7ca7a-8a6efcf0-6ec4-4bcb-b759-debc4dc0bb29',
                'Content-Type: application/json',
                'Accept: application/json'
            ),
        ));


        $response = curl_exec($curl);
        $json_response=json_decode($response);

        curl_close($curl);
        if(isset($json_response['bulkId'])){
            return true;
        }else{
            return false;
        }

    }





    //twillio
    public function makeCall($number,$id)
    {
        $drownies=RideDrownies::where('id',$id)->first();
        $DriverName=$drownies->rideRequest->user->name;
        $source=$drownies->rideRequest->source;
        $destination=$drownies->rideRequest->destination;

        $message='';
        $message+='Hello, this is a Automated voice call From Drowsiness detection System. Please Listen Carefully.';
        $message+='You are recieving this call because '.$DriverName.' has added you as Emergency Contact.';
        $message+='This is to Notify you that '.$DriverName.' is feeling drowsy while traveling towards '.$destination.' from '.$source.' Last Drowsiness Detected at '.$drownies->place;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://rgvw41.api.infobip.com/tts/3/single',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{"text":"'.$message.'","language":"en","voice":{"name":"Joanna","gender":"female"},"from":"442032864231","to":"'.$number.'"}',
            CURLOPT_HTTPHEADER => array(
                'Authorization: App c1feb0f8039222434ce5d16d30f7ca7a-8a6efcf0-6ec4-4bcb-b759-debc4dc0bb29',
                'Content-Type: application/json',
                'Accept: application/json'
            ),
        ));

        $response = curl_exec($curl);
        $json_response=json_decode($response);

        curl_close($curl);
        if(isset($json_response['bulkId'])){
            return true;
        }else{
            return false;
        }

    }







    //Handle Voice XML

    public function handleVoiceCall($id,Request $request)
    {
        $drownies=RideDrownies::where('id',$id)->first();
        $DriverName=$drownies->rideRequest->user->name;
        $source=$drownies->rideRequest->source;
        $destination=$drownies->rideRequest->destination;
        $response = new \Twilio\TwiML\VoiceResponse();
        $response->say('Hello, this is a Automated voice call From Drowsiness detection System. Please Listen Carefully.');
        $response->say('You are recieving this call because '.$DriverName.' has added you as Emergency Contact.');
        $response->say('This is to Notify you that '.$DriverName.' is feeling drowsy while traveling towards '.$destination.' from '.$source.' Last Drowsiness Detected at '.$drownies->place);
        return $response;
    }

}
