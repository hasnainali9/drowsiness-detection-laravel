<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\FaqResource;
use App\Http\Resources\API\SettingResource;
use App\Models\Faq;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function getApplicationSettingAboutUs(Request $request){
        $setting=Setting::where('key','aboutUs')->first();
        if(!empty($setting)){
            return response()->json(['success'=>true,'message'=>'App Setting','data'=>new SettingResource($setting)]);
        }else{
            return response()->json(['success'=>false,'message'=>'Invalid Key','data'=>[]]);
        }
    }

    public function getApplicationSettingTerms(Request $request){
        $setting=Setting::where('key','terms')->first();
        if(!empty($setting)){
            return response()->json(['success'=>true,'message'=>'App Setting','data'=>new SettingResource($setting)]);
        }else{
            return response()->json(['success'=>false,'message'=>'Invalid Key','data'=>[]]);
        }
    }

    public function getApplicationSettingPrivacy(Request $request){
        $setting=Setting::where('key','privacy')->first();
        if(!empty($setting)){
            return response()->json(['success'=>true,'message'=>'App Setting','data'=>new SettingResource($setting)]);
        }else{
            return response()->json(['success'=>false,'message'=>'Invalid Key','data'=>[]]);
        }
    }

    public function getFaqs(Request $request){
        $faqs=Faq::all();
        return response()->json(['success'=>true,'message'=>'Faqs List','data'=>FaqResource::collection($faqs)]);
    }
}
