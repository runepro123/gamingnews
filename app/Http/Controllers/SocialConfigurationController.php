<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SocialConfiguration;

class SocialConfigurationController extends Controller
{
    public function socialList() {
        $data['headerTitle'] = 'Social Media List';
        $data['socials'] = SocialConfiguration::get(); 

        return view('backend.admin.settings.social-configuration.index', $data);
    }

    public function add() {
        $data['headerTitle'] = 'Add New Social Media';

        return view('backend.admin..settings.social-configuration.add', $data);
    }

    public function insert(Request $request) {
        $request->validate([
            'name' => 'required',
            'icon' => 'required',
            'link' => 'required',
        ]);
        
        $icon = $request->file('icon');
        $iconName = $icon->getClientOriginalName();
        $timestamp = now()->timestamp; // Get the current 
        $directory = 'backend/uploads/social-configuration/';
        $iconUrl = $directory . $timestamp . '_' . $iconName; // Add timestamp to the filename
        $icon->move(public_path($directory), $timestamp . '_' . $iconName);

        $socialConfiguration = new SocialConfiguration;

        $socialConfiguration->name = $request->name;
        $socialConfiguration->icon = $iconUrl;
        $socialConfiguration->link = $request->link;
        $socialConfiguration->save();

        return redirect('settings/social-configuration/list')->with("success", "New social media successfully added.");
    }

    public function edit($id) {
        $data['social'] = SocialConfiguration::find($id);

        if(!empty($data['social'])) {
            $data['headerTitle'] = 'Edit Social Media';

            return view('backend.admin.settings/social-configuration.edit', $data);
        }else {
            abort(404);
        }
    }
    
    public function update(Request $request) {
        $request->validate([
            'name' => 'required',
            'icon' => $request->has('image') ? 'required|image|mimes:jpeg,png,jpg,gif,svg' : 'nullable',
            'link' => 'required'
        ]);
    
        $social = SocialConfiguration::find($request->social_id);

        $icon = $request->file('icon');  

        if(!empty($icon)) {
            if ($social->icon && file_exists(public_path($social->icon))) {
                unlink(public_path($social->icon));
            }
            $iconName = $icon->getClientOriginalName();
            $timestamp = now()->timestamp; // Get the current 
            $directory = 'backend/uploads/social-configuration/';
            $iconUrl = $directory . $timestamp . '_' . $iconName; // Add timestamp to the filename
            $icon->move(public_path($directory), $timestamp . '_' . $iconName);
            $social->icon = $iconUrl;
        }

        $social->name = $request->name;
        $social->link = $request->link;
        $social->save();
      
        return redirect('settings/social-configuration/list')->with("success", "Social media successfully updated.");
    }

    public function delete($id) {
        $social = SocialConfiguration::find($id);
    
        if (!empty($social)) {
            try {
                if ($social->icon && file_exists(public_path($social->icon))) {
                    unlink(public_path($social->icon));
                }

                $social->delete();
                return redirect('settings/social-configuration/list')->with("success", "Social media successfully deleted.");
            } catch (\Exception $e) {
                return redirect('settings/social-configuration/list')->with("error", "Error deleting category: " . $e->getMessage());
            }
        } else {
            abort(404);
        }
    }
}
