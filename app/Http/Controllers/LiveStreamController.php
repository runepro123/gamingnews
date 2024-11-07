<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\LiveStream;
use Validator;
use DB;

class LiveStreamController extends Controller
{
    public function liveStreamList() {
        $data['headerTitle'] = 'Live Stream List';
        $data['liveStreams'] = DB::table('live_streams')
                                    ->join('languages', 'live_streams.language_id', '=', 'languages.id')
                                    ->select('live_streams.*', 'languages.name as language_name')
                                    ->orderByDesc('live_streams.id') 
                                    ->get();

        return view('backend.admin.live-streams.index', $data);
    }

    public function add() {
        $data['headerTitle'] = 'Add New Live Stream';
        $data['languages'] = Language::where('status', 0)->get();

        return view('backend.admin.live-streams.add', $data);
    }

    public function insert(Request $request) {
        $rules = [
            'title' => 'required',
            'content_type' => 'required',
            'url' => 'required',
            'language_id' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ];

        $customMessage = [
            'content_type.required_if' => 'Select a content type',
            'language_id.required' => 'Please select a language.',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessage);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $image = $request->file('image');
        $imageName = $image->getClientOriginalName();
        $timestamp = now()->timestamp; // Get the current 
        $directory = 'backend/uploads/live-stream-images/';
        $imageUrl = $directory . $timestamp . '_' . $imageName; // Add timestamp to the filename
        $image->move($directory, $timestamp . '_' . $imageName);

        $liveStream = new LiveStream;

        $liveStream->title = $request->title;
        $liveStream->content_type = $request->content_type;
        $liveStream->url = $request->url;
        $liveStream->language_id = $request->language_id;
        $liveStream->image = $imageUrl;
        $liveStream->save();

        return redirect('live-stream/list')->with("success", "Live stream successfully added.");
    }

    public function edit($id) {
        $data['languages'] = Language::where('status', 0)->get();
        $data['liveStream'] = LiveStream::find($id);

        if(!empty($data['liveStream'])) {
            $data['headerTitle'] = 'Edit Live Stream';

            return view('backend.admin.live-streams.edit', $data);
        }else {
            abort(404);
        }
    }

    public function update(Request $request) {
        $request->validate([
            'title' => 'required',
            'url' => 'required',
            'image' => $request->has('image') ? 'required|image|mimes:jpeg,png,jpg,gif,svg' : 'nullable',
        ]);
    
        $image = $request->file('image');  
        
        $liveStream = LiveStream::find($request->live_stream_id);
        
        if(!empty($image)) {
            if ($liveStream->image && file_exists(public_path($liveStream->image))) {
                unlink(public_path($liveStream->image));
            }
            $imageName = $image->getClientOriginalName();
            $timestamp = now()->timestamp; // Get the current 
            $directory = 'backend/uploads/breaking-news-images/';
            $imageUrl = $directory . $timestamp . '_' . $imageName; // Add timestamp to the filename
            $image->move($directory, $timestamp . '_' . $imageName);
            $liveStream->image = $imageUrl;
        }

        $liveStream->title = $request->title;
        $liveStream->content_type = $request->content_type;
        $liveStream->url = $request->url;
        $liveStream->language_id = $request->language_id;
        $liveStream->status = $request->status;
        $liveStream->save();
      
        return redirect('live-stream/list')->with("success", "Live stream successfully updated.");
    }
    
    public function delete($id) {
        $liveStream = LiveStream::find($id);
    
        if (!empty($liveStream)) {
            try {
                if ($liveStream->image && file_exists(public_path($liveStream->image))) {
                    unlink(public_path($liveStream->image));
                }

                $liveStream->delete();
                return redirect('live-stream/list')->with("success", "Live stream successfully deleted.");
            } catch (\Exception $e) {
                return redirect('live-stream/list')->with("error", "Error deleting live stream: " . $e->getMessage());
            }
        } else {
            abort(404);
        }
    }
}
