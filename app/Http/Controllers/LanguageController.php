<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\Image;

class LanguageController extends Controller
{
    public function languageList() {
        $data['headerTitle'] = 'Language List';
        $data['languages'] = Language::latest()->get();

        return view('backend.admin.languages.index', $data);
    }

    public function add() {
        $data['headerTitle'] = 'Add New Language';

        return view('backend.admin.languages.add', $data);
    }

    public function insert(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'display_name' => 'required',
            'code' => 'required',
            'flag' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = $request->file('flag');
        $imageName = $image->getClientOriginalName();
        $timestamp = now()->timestamp; // Get the current 
        $directory = 'backend/uploads/images/';
        $imageUrl = $directory . $timestamp . '_' . $imageName; // Add timestamp to the filename
        $image->move(public_path($directory), $timestamp . '_' . $imageName);

        $language = new Language;
        $language->name = $request->name;
        $language->display_name = $request->display_name;
        $language->code = $request->code;
        $language->flag = $imageUrl;
        $language->is_rtl = $request->is_rtl;
        $language->save();

        return redirect('language/list')->with("success", "Language successfully added.");
    }
    
    public function edit($id) {
        $data['language'] = Language::find($id);

        if(!empty($data['language'])) {
            $data['headerTitle'] = 'Edit Language';

            return view('backend.admin.languages.edit', $data);
        }else {
            abort(404);
        }
    }

    public function update(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'display_name' => 'required',
            'code' => 'required',
        ]);
    
        $image = $request->file('flag');  
        
        $language = Language::find($request->language_id);
    
        if(!empty($image)) {
            if ($language->flag && file_exists(public_path($language->flag))) {
                unlink(public_path($language->flag));
            }
    
            $imageName = $image->getClientOriginalName();
            $timestamp = now()->timestamp; // Get the current 
            $directory = 'backend/uploads/images/';
            $imageUrl = $directory . $timestamp . '_' . $imageName; // Add timestamp to the filename
            $image->move(public_path($directory), $timestamp . '_' . $imageName);
    
            $language->flag = $imageUrl;
        }
      
        $language->name = $request->name;
        $language->display_name = $request->display_name;
        $language->code = $request->code;
        $language->is_rtl = $request->is_rtl;
        $language->status = $request->status;
        $language->save();

        return redirect('language/list')->with("success", "Language successfully updated.");
    }

    public function delete($id) {
        $language = Language::find($id);
    
        if (!empty($language)) {
            try {
                if ($language->flag && file_exists(public_path($language->flag))) {
                    unlink(public_path($language->flag));
                }

                $language->delete();
                return redirect('language/list')->with("success", "Language successfully deleted.");
            } catch (\Exception $e) {
                return redirect('language/list')->with("error", "Error deleting language: " . $e->getMessage());
            }
        } else {
            abort(404);
        }
    }

}
