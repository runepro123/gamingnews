<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Location;
use App\Models\News;
use App\Models\NewsFavorite;
use App\Models\Comment;
use Validator;
use DB;

class NewsController extends Controller
{
    public function newsList() {
        $data['headerTitle'] = 'News List';
        $data['allNews'] = DB::table('news')
                                    ->join('categories', 'news.category_id', '=', 'categories.id')
                                    ->join('languages', 'news.language_id', '=', 'languages.id')
                                    ->select('news.*', 'languages.name as language_name', 'categories.name as category_name')
                                    ->orderByDesc('news.id') 
                                    ->get();

        return view('backend.admin.news.index', $data);
    }

    public function add() {
        $data['headerTitle'] = 'Add New News';
        $data['languages'] = Language::where('status', 0)->get();
        $data['categories'] = Category::where('status', 0)->get();
        $data['tags'] = Tag::where('status', 0)->get();
        $data['locations'] = Location::get();

        return view('backend.admin.news.add', $data);
    }

    public function getCategoriesByLanguage($languageId) {
        $categories = Category::where('language_id', $languageId)
                      ->where('status', 0)
                      ->get();

        return response()->json($categories);
    }

    public function getTagsByLanguage($languageId) {
        $tags = Tag::where('language_id', $languageId)
                    ->where('status', 0)
                    ->get();
    
        return response()->json($tags);
    }
    
    public function insert(Request $request) {
        $rules = [
            'language_id' => 'required',
            'category_id' => 'required',
            'title' => 'required',
            'tags' => 'required|array',
            'location_id' => 'required',
            'youtube_url' => $request->input('content_type') == 2 ? 'required_if:content_type,2' : '',
            'other_url' => $request->input('content_type') == 3 ? 'required_if:content_type,3' : '',
            'video' => $request->input('content_type') == 4 ? 'required_if:content_type,4' : '',
            'featured_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'gallery_images' => 'required|array',
            'gallery_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required',
            'show_till' => 'required',
        ];

        $customMessage = [
            'language_id.required' => 'Please select a language.',
            'category_id.required' => 'Please select a category.',
            'location_id.required' => 'Please select a location.',
            'youtube_url.required_if' => 'YouTube URL is required',
            'other_url.required_if' => 'Other URL is required.',
            'video.required_if' => 'Please upload a video.',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessage);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $news = new News();
        $news->language_id = $request->language_id;
        $news->category_id = $request->category_id;
        $news->title = $request->title;
        $news->content_type = $request->content_type;
        $news->youtube_url = $request->youtube_url;
        $news->other_url = $request->other_url;

        $video = $request->file('video');
        if (!empty($video)) {
            $videoName = $video->getClientOriginalName();
            $timestamp = now()->timestamp; // Get the current 
            $directory = 'backend/uploads/news-videos/';
            $videoUrl = $directory . $timestamp . '_' . $videoName; // Add timestamp to the filename
            $video->move(public_path($directory), $timestamp . '_' . $videoName);
            $news->video = $videoUrl;
        }

        $news->location_id = $request->location_id;
        $news->tags = json_encode($request->tags);
        // Save featured image
        $featuredImage = $request->file('featured_image');
        $featuredImageName = $featuredImage->getClientOriginalName();
        $timestamp = now()->timestamp; // Get the current 
        $directory = 'backend/uploads/news-images/';
        $featuredImageUrl = $directory . $timestamp . '_' . $featuredImageName; // Add timestamp to the filename
        $featuredImage->move(public_path($directory), $timestamp . '_' . $featuredImageName);
        // Save featured image
        $news->featured_image = $featuredImageUrl;

        $galleryImageUrls = [];
        foreach ($request->file('gallery_images') as $galleryImage) {
            $galleryImageName = $galleryImage->getClientOriginalName();
            $timestamp = now()->timestamp;
            $uniqueId = uniqid(); // Generate a unique identifier
            $directory = 'backend/uploads/news-images/';
            $galleryImageUrl = $directory . $timestamp . '_' . $uniqueId . '_' . $galleryImageName;
            $galleryImage->move(public_path($directory), $timestamp . '_' . $uniqueId . '_' . $galleryImageName);
            $galleryImageUrls[] = $galleryImageUrl;
        }
        // Save image URLs to the database
        $news->gallery_images = json_encode($galleryImageUrls);
        $news->description = $request->description;
        $news->show_till = $request->show_till;
        $news->notify_users = $request->has('notify_users') ? $request->notify_users : 0;
        $news->save();
    
        return redirect('news/list')->with("success", "News successfully added.");
    }

    public function edit($id) {
        $data['languages'] = Language::where('status', 0)->get();
        $data['categories'] = Category::where('status', 0)->get();
        $data['tags'] = Tag::where('status', 0)->get();
        $data['locations'] = Location::get();
        $data['news'] = News::find($id);

        if(!empty($data['news'])) {
            $data['headerTitle'] = 'Edit News';

            return view('backend.admin.news.edit', $data);
        }else {
            abort(404);
        }
    }

    public function update(Request $request) {
        $rules = [
            'language_id' => 'required',
            'category_id' => 'required',
            'title' => 'required',
            'tags' => 'required|array',
            'location_id' => 'required',
            'youtube_url' => $request->input('content_type') == 2 ? 'required_if:content_type,2' : '',
            'other_url' => $request->input('content_type') == 3 ? 'required_if:content_type,3' : '',
            'video' => $request->has('video') ? 'required|mimes:mp4,webm' : 'nullable',
            'featured_image' => $request->has('featured_image') ? 'required|image|mimes:jpeg,png,jpg,gif,svg' : 'nullable',
            'gallery_images' => $request->has('gallery_images') ? 'required|array' : 'nullable',
            'gallery_images.*' => $request->has('gallery_images') ? 'image|mimes:jpeg,png,jpg,gif|max:2048' : 'nullable',
            'description' => 'required',
            'show_till' => 'required',
        ];

        $customMessage = [
            'language_id.required' => 'Please select a language.',
            'category_id.required' => 'Please select a category.',
            'location_id.required' => 'Please select a location.',
            'youtube_url.required_if' => 'YouTube URL is required',
            'other_url.required_if' => 'Other URL is required.',
            'video.required' => 'Video file is required.',
            'video.mimes' => 'The video must be a file of type: mp4, webm.',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessage);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $news = News::find($request->news_id);
        $news->language_id = $request->language_id;
        $news->category_id = $request->category_id;
        $news->title = $request->title;
        $news->content_type = $request->content_type;
        $news->youtube_url = $request->youtube_url;
        $news->other_url = $request->other_url;

        $video = $request->file('video');        
        if (!empty($video)) {
            if($news->video && file_exists(public_path($news->video))) {
                unlink(public_path($news->video));
            }
            $videoName = $video->getClientOriginalName();
            $timestamp = now()->timestamp; // Get the current 
            $directory = 'backend/uploads/news-videos/';
            $videoUrl = $directory . $timestamp . '_' . $videoName; // Add timestamp to the filename
            $video->move(public_path($directory), $timestamp . '_' . $videoName);
            $news->video = $videoUrl;
        }

        $news->location_id = $request->location_id;
        $news->tags = json_encode($request->tags);

        $featuredImage = $request->file('featured_image');
        if(!empty($featuredImage)) {
            if ($news->featured_image && file_exists(public_path($news->featured_image))) {
                unlink(public_path($news->featured_image));
            }
            $featuredImageName = $featuredImage->getClientOriginalName();
            $timestamp = now()->timestamp; // Get the current 
            $directory = 'backend/uploads/news-images/';
            $featuredImageUrl = $directory . $timestamp . '_' . $featuredImageName; // Add timestamp to the filename
            $featuredImage->move(public_path($directory), $timestamp . '_' . $featuredImageName);
            $news->featured_image = $featuredImageUrl;
        }

        // Check if new images are selected
        if ($request->hasFile('gallery_images')) {
            // Delete existing images
            if ($news->gallery_images) {
                $galleryImages = json_decode($news->gallery_images, true);
                    foreach ($galleryImages as $image) {
                        if (file_exists(public_path($image))) {
                            unlink(public_path($image));
                        }
                    }
                }
            
                // Save new images
                $galleryImageUrls = [];
                foreach ($request->file('gallery_images') as $galleryImage) {
                    $galleryImageName = $galleryImage->getClientOriginalName();
                    $timestamp = now()->timestamp;
                    $uniqueId = uniqid(); // Generate a unique identifier
                    $directory = 'backend/uploads/news-images/';
                    $galleryImageUrl = $directory . $timestamp . '_' . $uniqueId . '_' . $galleryImageName;
                    $galleryImage->move(public_path($directory), $timestamp . '_' . $uniqueId . '_' . $galleryImageName);
                    $galleryImageUrls[] = $galleryImageUrl;
            }
            // Save image URLs to the database
            $news->gallery_images = json_encode($galleryImageUrls);
        }

        $news->description = $request->description;
        $news->show_till = $request->show_till;
        $news->status = $request->status;
        $news->notify_users = $request->has('notify_users') ? $request->notify_users : 0;
        $news->save();
      
        return redirect('news/list')->with("success", "News successfully updated.");
    }

    public function delete($id) {
        $news = News::find($id);
    
        if (!empty($news)) {
            NewsFavorite::where('news_id', $id)->delete();

            Comment::where('news_id', $id)->delete();

            if($news->video && file_exists(public_path($news->video))) {
                unlink(public_path($news->video));
            }

            if ($news->featured_image && file_exists(public_path($news->featured_image))) {
                unlink(public_path($news->featured_image));
            }

            if ($news->gallery_images) {
                $galleryImages = json_decode($news->gallery_images, true);

                foreach ($galleryImages as $image) {
                    if (file_exists(public_path($image))) {
                        unlink(public_path($image));
                    }
                }
            }

            $news->delete();
            return redirect('news/list')->with("success", "News successfully deleted.");

        } else {
            abort(404);
        }
    }
}
