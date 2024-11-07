<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\Reel;
use DB;
use Validator;

class ReelController extends Controller
{
    public function reelList() {
        $data['headerTitle'] = 'Reels List';
        $data['reels'] = DB::table('reels')
                                    ->join('languages', 'reels.language_id', '=', 'languages.id')
                                    ->select('reels.*', 'languages.name as language_name')
                                    ->orderByDesc('reels.id')
                                    ->get();

        return view('backend.admin.reels.index', $data);
    }

    public function add() {
        $data['headerTitle'] = 'Add New Reel';
        $data['languages'] = Language::where('status', 0)->get();

        return view('backend.admin.reels.add', $data);
    }

    public function insert(Request $request) {
        $rules = [
            'title' => 'required',
            'content_type' => 'required',
            'youtube_url' => $request->input('content_type') == 2 ? 'required_if:content_type,2' : '',
            'other_url' => $request->input('content_type') == 3 ? 'required_if:content_type,3' : '',
            'video' => $request->input('content_type') == 4 ? 'required_if:content_type,4' : '',
            'language_id' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'description' => 'required',
        ];

        $customMessage = [
            'youtube_url.required_if' => 'YouTube URL is required',
            'other_url.required_if' => 'Other URL is required.',
            'video.required_if' => 'Please upload a video.',
            'language_id.required' => 'Please select a language.',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessage);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $image = $request->file('image');
        $imageName = $image->getClientOriginalName();
        $timestamp = now()->timestamp; // Get the current 
        $directory = 'backend/uploads/reels-images/';
        $imageUrl = $directory . $timestamp . '_' . $imageName; // Add timestamp to the filename
        $image->move(public_path($directory), $timestamp . '_' . $imageName);

        $video = $request->file('video');

        $reel = new Reel;

        if (!empty($video)) {
            $videoName = $video->getClientOriginalName();
            $timestamp = now()->timestamp; // Get the current 
            $directory = 'backend/uploads/reels-videos/';
            $videoUrl = $directory . $timestamp . '_' . $videoName; // Add timestamp to the filename
            $video->move(public_path($directory), $timestamp . '_' . $videoName);
            $reel->video = $videoUrl;
        }

        $reel->title = $request->title;
        $reel->content_type = $request->content_type;
        $reel->youtube_url = $request->youtube_url;
        $reel->other_url = $request->other_url;
        $reel->language_id = $request->language_id;
        $reel->image = $imageUrl;
        $reel->description = $request->description;
        $reel->total_views = 0;
        $reel->save();

        return redirect('reel/list')->with("success", "Reel successfully added.");
    }

    public function edit($id) {
        $data['languages'] = Language::where('status', 0)->get();
        $data['reel'] = DB::table('reels')
                                    ->join('languages', 'reels.language_id', '=', 'languages.id')
                                    ->select('reels.*', 'languages.name as language_name')
                                    ->where('reels.id', $id)
                                    ->first();

        if(!empty($data['reel'])) {
            $data['headerTitle'] = 'Edit Reel';

            return view('backend.admin.reels.edit', $data);
        }else {
            abort(404);
        }
    }

    public function update(Request $request) {
        $rules = [
            'title' => 'required',
            'youtube_url' => $request->input('content_type') == 2 ? 'required_if:content_type,2' : '',
            'other_url' => $request->input('content_type') == 3 ? 'required_if:content_type,3' : '',
            'video' => $request->has('video') ? 'required|mimes:mp4,webm' : 'nullable',
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
        
        $reel = Reel::find($request->reel_id);
        
        if (!empty($video)) {
            if($reel->video && file_exists(public_path($reel->video))) {
                unlink(public_path($reel->video));
            }
            $videoName = $video->getClientOriginalName();
            $timestamp = now()->timestamp; // Get the current 
            $directory = 'backend/uploads/reels-videos/';
            $videoUrl = $directory . $timestamp . '_' . $videoName; // Add timestamp to the filename
            $video->move(public_path($directory), $timestamp . '_' . $videoName);
            $reel->video = $videoUrl;
        }

        if(!empty($image)) {
            if ($reel->image && file_exists(public_path($reel->image))) {
                unlink(public_path($reel->image));
            }
            $imageName = $image->getClientOriginalName();
            $timestamp = now()->timestamp; // Get the current 
            $directory = 'backend/uploads/reels-images/';
            $imageUrl = $directory . $timestamp . '_' . $imageName; // Add timestamp to the filename
            $image->move(public_path($directory), $timestamp . '_' . $imageName);
            $reel->image = $imageUrl;
        }

        $reel->title = $request->title;
        $reel->content_type = $request->content_type;
        $reel->youtube_url = $request->youtube_url;
        $reel->other_url = $request->other_url;
        $reel->language_id = $request->language_id;
        $reel->description = $request->description;
        $reel->status = $request->status;
        $reel->save();
      
        return redirect('reel/list')->with("success", "Reel successfully updated.");
    }

    public function delete($id) {
        $reel = Reel::find($id);
    
        if (!empty($reel)) {
            try {
                if ($reel->image && file_exists(public_path($reel->image))) {
                    unlink(public_path($reel->image));
                }
                
                if($reel->video && file_exists(public_path($reel->video))) {
                    unlink(public_path($reel->video));
                }

                $reel->delete();
                return redirect('reel/list')->with("success", "Reel successfully deleted.");

            } catch (\Exception $e) {
                return redirect('reel/list')->with("error", "Error deleting reel: " . $e->getMessage());
            }

        } else {
            abort(404);
        }
    }
}
