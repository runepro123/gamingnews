<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WebConfiguration;

class WebConfigurationController extends Controller
{
    public function showWebConfigurationForm() {
        $data['headerTitle'] = 'Wen Configuration';
        
        $data['webConfiguration'] = WebConfiguration::first();

        return view('backend.admin.settings.web-configuration', $data);
    }

    public function updateWebConfiguration(Request $request) {
        $request->validate([
            'header_contact' => 'required',
            'footer_contact' => 'required',
            'footer_description' => 'required',
            'footer_address' => 'required',
            'copyright' => 'required',
        ]);

        // Check if WebConfiguration record exists
        $webConfiguration = WebConfiguration::first();
        if (!$webConfiguration) {
            $webConfiguration = new WebConfiguration();
        }

        $headerLogo = $request->file('header_logo');
        if(!empty($headerLogo)) {
            if ($webConfiguration->header_logo && file_exists(public_path($webConfiguration->header_logo))) {
                unlink(public_path($webConfiguration->header_logo));
            }
            $headerLogoName = $headerLogo->getClientOriginalName();
            $timestamp = now()->timestamp; // Get the current 
            $directory = 'backend/uploads/web-configuration/';
            $headerLogoUrl = $directory . $timestamp . '_' . $headerLogoName; // Add timestamp to the filename
            $headerLogo->move(public_path($directory), $timestamp . '_' . $headerLogoName);
            $webConfiguration->header_logo = $headerLogoUrl;
        }

        $footerLogo = $request->file('footer_logo');
        if(!empty($footerLogo)) {
            if ($webConfiguration->footer_logo && file_exists(public_path($webConfiguration->footer_logo))) {
                unlink(public_path($webConfiguration->footer_logo));
            }
            $footerLogoName = $footerLogo->getClientOriginalName();
            $timestamp = now()->timestamp; // Get the current 
            $directory = 'backend/uploads/web-configuration/';
            $footerLogoUrl = $directory . $timestamp . '_' . $footerLogoName; // Add timestamp to the filename
            $footerLogo->move(public_path($directory), $timestamp . '_' . $footerLogoName);
            $webConfiguration->footer_logo = $footerLogoUrl;
        }

        $googlePlayAppLogo = $request->file('google_play_app_logo');
        if(!empty($googlePlayAppLogo)) {
            if ($webConfiguration->google_play_app_logo && file_exists(public_path($webConfiguration->google_play_app_logo))) {
                unlink(public_path($webConfiguration->google_play_app_logo));
            }
            $googlePlayAppLogoName = $googlePlayAppLogo->getClientOriginalName();
            $timestamp = now()->timestamp; // Get the current 
            $directory = 'backend/uploads/web-configuration/';
            $googlePlayAppLogoUrl = $directory . $timestamp . '_' . $googlePlayAppLogoName; // Add timestamp to the filename
            $googlePlayAppLogo->move(public_path($directory), $timestamp . '_' . $googlePlayAppLogoName);
            $webConfiguration->google_play_app_logo = $googlePlayAppLogoUrl;
        }

        $appStoreAppLogo = $request->file('app_store_logo');
        if(!empty($appStoreAppLogo)) {
            if ($webConfiguration->app_store_logo && file_exists(public_path($webConfiguration->app_store_logo))) {
                unlink(public_path($webConfiguration->app_store_logo));
            }
            $appStoreAppLogoName = $appStoreAppLogo->getClientOriginalName();
            $timestamp = now()->timestamp; // Get the current 
            $directory = 'backend/uploads/web-configuration/';
            $appStoreAppLogoUrl = $directory . $timestamp . '_' . $appStoreAppLogoName; // Add timestamp to the filename
            $appStoreAppLogo->move(public_path($directory), $timestamp . '_' . $appStoreAppLogoName);
            $webConfiguration->app_store_logo = $appStoreAppLogoUrl;
        }

        $webConfiguration->frontend_api_base_url = $request->frontend_api_base_url;
        $webConfiguration->web_app_name = $request->web_app_name;
        $webConfiguration->nav_text_color = $request->nav_text_color;
        $webConfiguration->web_color = $request->color;
        $webConfiguration->header_contact = $request->header_contact;
        $webConfiguration->footer_contact = $request->footer_contact;
        $webConfiguration->google_play_app_link = $request->google_play_app_link;
        $webConfiguration->app_store_link = $request->app_store_link;
        $webConfiguration->footer_description = $request->footer_description;
        $webConfiguration->footer_address = $request->footer_address;
        $webConfiguration->copyright = $request->copyright;
        $webConfiguration->save();

        return redirect()->back()->with("success", "Web configuration data successfully updated.");
    }
}
