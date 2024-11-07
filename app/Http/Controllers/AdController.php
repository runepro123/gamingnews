<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ad;

class AdController extends Controller
{
    public function adList() {
        $ads = Ad::first();

        return view('backend.admin.ads.ads', ['ads' => $ads]);
    }

    public function updateAds(Request $request) {
        $request->validate([
            'header_ad_img' => $request->has('header_ad_img') ? 'required|image|mimes:jpeg,png,jpg,gif,svg' : 'nullable',
            'header_ad_link' => 'required',
            'banner_ad_img' => $request->has('banner_ad_img') ? 'required|image|mimes:jpeg,png,jpg,gif,svg' : 'nullable',
            'banner_ad_link' => 'required',
            'card_ad_img' => $request->has('card_ad_img') ? 'required|image|mimes:jpeg,png,jpg,gif,svg' : 'nullable',
            'card_ad_link' => 'required',
            'sidebar_ad_img' => $request->has('sidebar_ad_img') ? 'required|image|mimes:jpeg,png,jpg,gif,svg' : 'nullable',
            'sidebar_ad_link' => 'required',
            'footer_top_ad_img' => $request->has('footer_top_ad_img') ? 'required|image|mimes:jpeg,png,jpg,gif,svg' : 'nullable',
            'footer_top_ad_link' => 'required',
            'footer_ad_img' => $request->has('footer_ad_img') ? 'required|image|mimes:jpeg,png,jpg,gif,svg' : 'nullable',
            'footer_ad_link' => 'required',
        ]);

        // Check if Ad record exists
        $ads = Ad::first();
        if (!$ads) {
            $ads = new Ad();
        }

        $headerAdImg = $request->file('header_ad_img');
        if(!empty($headerAdImg)) {
            if ($ads->header_ad_img && file_exists(public_path($ads->header_ad_img))) {
                unlink(public_path($ads->header_ad_img));
            }
            $headerAdImgName = $headerAdImg->getClientOriginalName();
            $timestamp = now()->timestamp; // Get the current 
            $directory = 'backend/uploads/ads/';
            $headerAdImgUrl = $directory . $timestamp . '_' . $headerAdImgName; // Add timestamp to the filename
            $headerAdImg->move(public_path($directory), $timestamp . '_' . $headerAdImgName);
            $ads->header_ad_img = $headerAdImgUrl;
        }
        
        $bannerAdImg = $request->file('banner_ad_img');
        if(!empty($bannerAdImg)) {
            if ($ads->banner_ad_img && file_exists(public_path($ads->banner_ad_img))) {
                unlink(public_path($ads->banner_ad_img));
            }
            $bannerAdImgName = $bannerAdImg->getClientOriginalName();
            $timestamp = now()->timestamp; // Get the current 
            $directory = 'backend/uploads/ads/';
            $bannerAdImgUrl = $directory . $timestamp . '_' . $bannerAdImgName; // Add timestamp to the filename
            $bannerAdImg->move(public_path($directory), $timestamp . '_' . $bannerAdImgName);
            $ads->banner_ad_img = $bannerAdImgUrl;
        }

        $cardAdImg = $request->file('card_ad_img');
        if(!empty($cardAdImg)) {
            if ($ads->card_ad_img && file_exists(public_path($ads->card_ad_img))) {
                unlink(public_path($ads->card_ad_img));
            }
            $cardAdImgName = $cardAdImg->getClientOriginalName();
            $timestamp = now()->timestamp; // Get the current 
            $directory = 'backend/uploads/ads/';
            $cardAdImgUrl = $directory . $timestamp . '_' . $cardAdImgName; // Add timestamp to the filename
            $cardAdImg->move(public_path($directory), $timestamp . '_' . $cardAdImgName);
            $ads->card_ad_img = $cardAdImgUrl;
        }

        $sidebarAdImg = $request->file('sidebar_ad_img');
        if(!empty($sidebarAdImg)) {
            if ($ads->sidebar_ad_img && file_exists(public_path($ads->sidebar_ad_img))) {
                unlink(public_path($ads->sidebar_ad_img));
            }
            $sidebarAdImgName = $sidebarAdImg->getClientOriginalName();
            $timestamp = now()->timestamp; // Get the current 
            $directory = 'backend/uploads/ads/';
            $sidebarAdImgUrl = $directory . $timestamp . '_' . $sidebarAdImgName; // Add timestamp to the filename
            $sidebarAdImg->move(public_path($directory), $timestamp . '_' . $sidebarAdImgName);
            $ads->sidebar_ad_img = $sidebarAdImgUrl;
        }

        $footerTopAdImg = $request->file('footer_top_ad_img');
        if(!empty($footerTopAdImg)) {
            if ($ads->footer_top_ad_img && file_exists(public_path($ads->footer_top_ad_img))) {
                unlink(public_path($ads->footer_top_ad_img));
            }
            $footerAdImgName = $footerTopAdImg->getClientOriginalName();
            $timestamp = now()->timestamp; // Get the current 
            $directory = 'backend/uploads/ads/';
            $footerAdImgUrl = $directory . $timestamp . '_' . $footerAdImgName; // Add timestamp to the filename
            $footerTopAdImg->move(public_path($directory), $timestamp . '_' . $footerAdImgName);
            $ads->footer_top_ad_img = $footerAdImgUrl;
        }

        $footerAdImg = $request->file('footer_ad_img');
        if(!empty($footerAdImg)) {
            if ($ads->footer_ad_img && file_exists(public_path($ads->footer_ad_img))) {
                unlink(public_path($ads->footer_ad_img));
            }
            $footerAdImgName = $footerAdImg->getClientOriginalName();
            $timestamp = now()->timestamp; // Get the current 
            $directory = 'backend/uploads/ads/';
            $footerAdImgUrl = $directory . $timestamp . '_' . $footerAdImgName; // Add timestamp to the filename
            $footerAdImg->move(public_path($directory), $timestamp . '_' . $footerAdImgName);
            $ads->footer_ad_img = $footerAdImgUrl;
        }

        $ads->header_ad_link = $request->header_ad_link;
        $ads->banner_ad_link = $request->banner_ad_link;
        $ads->card_ad_link = $request->card_ad_link;
        $ads->sidebar_ad_link = $request->sidebar_ad_link;
        $ads->footer_top_ad_link = $request->footer_top_ad_link;
        $ads->footer_ad_link = $request->footer_ad_link;
        $ads->save();

        return redirect()->back()->with("success", "Ads data successfully updated.");
    }
}
