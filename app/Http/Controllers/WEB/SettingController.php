<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function getAboutUs(Request $request){
        $setting=Setting::where('key','aboutUs')->first();
        return view('setting.aboutus',compact('setting'));
    }

    public function updateAboutUs(Request $request){
        Setting::updateOrCreate(
            ['key' => 'aboutUs'],
            ['value' => urlencode($request->value)]
        );
        return redirect()->back()->with('message', 'About Page Updated!');
    }

    public function getTermsCondition(Request $request){
        $setting=Setting::where('key','terms')->first();
        return view('setting.terms',compact('setting'));
    }

    public function updateTermsCondition(Request $request){
        Setting::updateOrCreate(
            ['key' => 'terms'],
            ['value' => urlencode($request->value)]
        );
        return redirect()->back()->with('message', 'About Page Updated!');
    }
    public function getPrivacyPolicy(Request $request){
        $setting=Setting::where('key','privacy')->first();
        return view('setting.privacy',compact('setting'));
    }

    public function updatePrivacyPolicy(Request $request){
        Setting::updateOrCreate(
            ['key' => 'privacy'],
            ['value' => urlencode($request->value)]
        );
        return redirect()->back()->with('message', 'About Page Updated!');
    }
}
