<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\Category;
use App\Models\Slider;
use App\Models\SliderFavorite;
use App\Models\Comment;
use Validator;
use DB;

class SliderController extends Controller
{
    public function sliderList() {
        $data['headerTitle'] = 'Slider List';
        $data['sliders'] = DB::table('sliders')
                                    ->join('languages', 'sliders.language_id', '=', 'languages.id')
                                    ->join('categories', 'sliders.category_id', '=', 'categories.id')
                                    ->select('sliders.*', 'languages.name as language_name', 'categories.name as category_name')
                                    ->orderByDesc('sliders.id')
                                    ->get();

        return view('backend.admin.slider.index', $data);
    }

    public function add() {
        $data['headerTitle'] = 'Add New Slider';
        $data['languages'] = Language::where('status', 0)->get();
        $data['categories'] = Category::where('status', 0)->get();

        return view('backend.admin.slider.add', $data);
    }

    public function getCategoriesByLanguage($languageId) {
        $categories = Category::where('language_id', $languageId)
                      ->where('status', 0)
                      ->get();

        return response()->json($categories);
    }

    public function insert(Request $request) {
        $rules = [
            'title' => 'required',
            'youtube_url' => $request->input('content_type') == 2 ? 'required_if:content_type,2' : '',
            'other_url' => $request->input('content_type') == 3 ? 'required_if:content_type,3' : '',
            'video' => $request->input('content_type') == 4 ? 'required_if:content_type,4' : '',
            'language_id' => 'required',
            'category_id' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'description' => 'required',
        ];

        $customMessage = [
            'youtube_url.required_if' => 'YouTube URL is required',
            'other_url.required_if' => 'Other URL is required.',
            'video.required_if' => 'Please upload a video.',
            'language_id.required' => 'Please select a language.',
            'category_id.required' => 'Please select a category.',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessage);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $image = $request->file('image');
        $imageName = $image->getClientOriginalName();
        $timestamp = now()->timestamp; // Get the current 
        $directory = 'backend/uploads/slider-images/';
        $imageUrl = $directory . $timestamp . '_' . $imageName; // Add timestamp to the filename
        $image->move(public_path($directory), $timestamp . '_' . $imageName);

        $video = $request->file('video');

        $slider = new Slider;

        if (!empty($video)) {
            $videoName = $video->getClientOriginalName();
            $timestamp = now()->timestamp; // Get the current 
            $directory = 'backend/uploads/slider-videos/';
            $videoUrl = $directory . $timestamp . '_' . $videoName; // Add timestamp to the filename
            $video->move(public_path($directory), $timestamp . '_' . $videoName);
            $slider->video = $videoUrl;
        }

        $slider->language_id = $request->language_id;
        $slider->category_id = $request->category_id;
        $slider->title = $request->title;
        $slider->content_type = $request->content_type;
        $slider->youtube_url = $request->youtube_url;
        $slider->other_url = $request->other_url;
        $slider->image = $imageUrl;
        $slider->description = $request->description;
        $slider->total_views = 0;
        $slider->save();

        return redirect('slider/list')->with("success", "Slider successfully added.");
    }

    public function edit($id) {
        $data['languages'] = Language::where('status', 0)->get();
        $data['categories'] = Category::where('status', 0)->get();
        $data['slider'] = DB::table('sliders')
                                    ->join('languages', 'sliders.language_id', '=', 'languages.id')
                                    ->join('categories', 'sliders.category_id', '=', 'categories.id')
                                    ->select('sliders.*', 'languages.name as language_name', 'categories.name as category_name')
                                    ->where('sliders.id', $id)
                                    ->first();

        if(!empty($data['slider'])) {
            $data['headerTitle'] = 'Edit Slider';

            return view('backend.admin.slider.edit', $data);
        }else {
            abort(404);
        }
    }

    public function update(Request $request) {
        $rules = [
            'title' => 'required',
            'youtube_url' => $request->input('content_type') == 2 ? 'required_if:content_type,2' : '',
            'other_url' => $request->input('content_type') == 3 ? 'required_if:content_type,3' : '',
            'video' => $request->has('video') ? 'required' : 'nullable',
            'image' => $request->has('image') ? 'required|image|mimes:jpeg,png,jpg,gif,svg' : 'nullable',
            'description' => 'required',
        ];

        $customMessage = [
            'youtube_url.required_if' => 'YouTube URL is required',
            'other_url.required_if' => 'Other URL is required.',
            'video.required' => 'Video file is required.',
            'video.mimes' => 'The video must be a file of type: mp4, webm.',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessage);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $video = $request->file('video');  
        $image = $request->file('image');  
        
        $slider = Slider::find($request->slider_id);
        
        if (!empty($video)) {
            if($slider->video && file_exists(public_path($slider->video))) {
                unlink(public_path($slider->video));
            }
            $videoName = $video->getClientOriginalName();
            $timestamp = now()->timestamp; // Get the current 
            $directory = 'backend/uploads/slider-videos/';
            $videoUrl = $directory . $timestamp . '_' . $videoName; // Add timestamp to the filename
            $video->move(public_path($directory), $timestamp . '_' . $videoName);
            $slider->video = $videoUrl;
        }

        if(!empty($image)) {
            if ($slider->image && file_exists(public_path($slider->image))) {
                unlink(public_path($slider->image));
            }
            $imageName = $image->getClientOriginalName();
            $timestamp = now()->timestamp; // Get the current 
            $directory = 'backend/uploads/slider-images/';
            $imageUrl = $directory . $timestamp . '_' . $imageName; // Add timestamp to the filename
            $image->move(public_path($directory), $timestamp . '_' . $imageName);
            $slider->image = $imageUrl;
        }

        $slider->language_id = $request->language_id;
        $slider->category_id = $request->category_id;
        $slider->title = $request->title;
        $slider->content_type = $request->content_type;
        $slider->youtube_url = $request->youtube_url;
        $slider->other_url = $request->other_url;
        $slider->description = $request->description;
        $slider->status = $request->status;
        $slider->save();
      
        return redirect('slider/list')->with("success", "Slider successfully updated.");
    }
    
    public function delete($id) {
        $slider = Slider::find($id);

        if (!empty($slider)) {
            try {
                SliderFavorite::where('slider_id', $id)->delete();

                Comment::where('slider_id', $id)->delete();

                if ($slider->image && file_exists(public_path($slider->image))) {
                    unlink(public_path($slider->image));
                }

                if ($slider->video && file_exists(public_path($slider->video))) {
                    unlink(public_path($slider->video));
                }

                $slider->delete();

                return redirect('slider/list')->with("success", "Slider successfully deleted.");
            } catch (\Exception $e) {
                return redirect('slider/list')->with("error", "Error deleting slider: " . $e->getMessage());
            }
        } else {
            abort(404);
        }
    }

}
