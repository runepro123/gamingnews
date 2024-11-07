<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\SliderFavorite;
use App\Models\Comment;
use DB;
use Auth;

class SliderController extends Controller
{
    public function getSlider() {
        try {
            $sliders = DB::table('sliders')
                ->join('languages', 'sliders.language_id', '=', 'languages.id')
                ->join('categories', 'sliders.category_id', '=', 'categories.id')
                ->select('sliders.*', 'sliders.image as featured_image', 'languages.name as language_name', 'categories.name as category_name')
                ->addSelect(DB::raw('null as tags')) // Add null for non-existing field 'tags'
                ->addSelect(DB::raw('null as location_id'))
                ->addSelect(DB::raw('null as location_name'))
                ->addSelect(DB::raw('null as show_till'))
                ->addSelect(DB::raw('null as notify_users'))
                ->orderByDesc('sliders.id') 
                ->where('sliders.status', 0)
                ->inRandomOrder()
                ->take(5)  
                ->get();

            if (!$sliders) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Sliders not found',
                ], 404);
            }
    
            return response()->json([
                'status' => 'success',
                'message' => 'Sliders retrieved successfully',
                'data' => $sliders,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Internal Server Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function getSliderById($id) {
        try {
            $slider = DB::table('sliders')
                ->join('languages', 'sliders.language_id', '=', 'languages.id')
                ->join('categories', 'sliders.category_id', '=', 'categories.id')
                ->select('sliders.*', 'sliders.image as featured_image', 'languages.name as language_name', 'categories.name as category_name')
                ->addSelect(DB::raw('null as tags')) // Add null for non-existing field 'tags'
                ->addSelect(DB::raw('null as location_id'))
                ->addSelect(DB::raw('null as location_name'))
                ->addSelect(DB::raw('null as show_till'))
                ->addSelect(DB::raw('null as notify_users'))
                ->where('sliders.id', $id)
                ->first();
            
            $comments = Comment::with('user') 
                ->where('slider_id', $id)
                ->latest('created_at')
                ->get();
                
            if (!$slider) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Slider not found',
                ], 404);
            }

            $relatedSliders = DB::table('sliders')
                ->join('languages', 'sliders.language_id', '=', 'languages.id')
                ->join('categories', 'sliders.category_id', '=', 'categories.id')
                ->select('sliders.*', 'sliders.image as featured_image', 'languages.name as language_name', 'categories.name as category_name')
                ->addSelect(DB::raw('null as tags')) // Add null for non-existing field 'tags'
                ->addSelect(DB::raw('null as location_id'))
                ->addSelect(DB::raw('null as location_name'))
                ->addSelect(DB::raw('null as show_till'))
                ->addSelect(DB::raw('null as notify_users'))
                ->where('sliders.category_id', $slider->category_id)
                ->where('sliders.id', '<>', $slider->id) // Exclude the current news
                ->where('sliders.status', 0)
                ->limit(4)
                ->get();

            $url = url()->current();
            
            $data = [
                'slider' => $slider,
                'url' => $url,
                'comments' => $comments,
                'relatedSliders' => $relatedSliders->isEmpty() ? null : $relatedSliders,
            ];
            
            return response()->json([
                'status' => 'success',
                'message' => 'Slider retrieved successfully',
                'data' => $data,
            ], 200);
    
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Internal Server Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function getSliderByCategory($category_id) {
        try {
            $sliders = DB::table('sliders')
                ->join('languages', 'sliders.language_id', '=', 'languages.id')
                ->join('categories', 'sliders.category_id', '=', 'categories.id')
                ->select('sliders.*', 'sliders.image as featured_image', 'languages.name as language_name', 'categories.name as category_name')
                ->addSelect(DB::raw('null as tags')) // Add null for non-existing field 'tags'
                ->addSelect(DB::raw('null as location_id'))
                ->addSelect(DB::raw('null as location_name'))
                ->addSelect(DB::raw('null as show_till'))
                ->addSelect(DB::raw('null as notify_users'))
                ->where('sliders.category_id', $category_id)
                ->where('sliders.status', 0)
                ->get();

            if ($sliders->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Slider not found for this category',
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Slider retrieved successfully',
                'data' => $sliders,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Internal Server Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function incrementSliderViews(Request $request) {
        $slider = Slider::find($request->slider_id);

        if ($slider) {
            // Increment the news's total_views column by 1
            $slider->increment('total_views');

            return response()->json([
                'status' => 'success',
                'message' => 'Views added successfully',
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Slider not found or views could not be added'
            ], 404);
        }
    }

    public function incrementSliderFavorite(Request $request) {
        $slider = Slider::find($request->slider_id);

        if ($slider) {
            // Increment the news's favorite_count column by 1
            $slider->increment('favorite_count');

            return response()->json([
                'status' => 'success',
                'message' => 'Favorite added successfully',
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Slider not found or views could not be added'
            ], 404);
        }
    }

    public function favorite($sliderId) {
        $userId = Auth::id();

        $existingFavorite = SliderFavorite::where('user_id', $userId)
            ->where('slider_id', $sliderId)
            ->first();

        if ($existingFavorite) {
            // Remove favorite
            $existingFavorite->delete();
            $slider = Slider::find($sliderId);
            $slider->favorite_count -= 1; // Update favorite_count
            $slider->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Removed favorite'
            ], 200);
        } else {
            // Add favorite
            SliderFavorite::create(['user_id' => $userId, 'slider_id' => $sliderId]);
            $slider = Slider::find($sliderId);
            $slider->favorite_count += 1; // Update favorite_count
            $slider->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Added favorite',
            ], 200);
        }
    }

}
