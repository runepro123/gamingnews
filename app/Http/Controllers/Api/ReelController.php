<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reel;

class ReelController extends Controller
{
    public function getReels(Request $request) {
        try {
            $limit = $request->input('count', 10);
            $page = $request->input('page', 1); 
            $offset = ($page * $limit) - $limit;

            // Get 50 Reels Randomly
            $randomReels = Reel::latest()->limit(50)->inRandomOrder();

            $randomReels =  $randomReels->offset($offset)->limit($limit)->get();

            if ($randomReels->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Reels not found',
                ], 404);
            }
    
            return response()->json([
                'status' => 'success',
                'count' => $randomReels->count(),
                'pages' => $page,
                'message' => 'Reels retrieved successfully',
                'data' => $randomReels,
            ], 200);
    
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Internal Server Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function getReelsById($id) {
        try {
            $reel = Reel::find($id);
                
            if (!$reel) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Reel not found',
                ], 404);
            }

            $relatedReels = Reel::where('id', '<>', $id)
                ->inRandomOrder()
                ->limit(4)
                ->get();
            
            $url = url()->current();
    
            $data = [
                'reel' => $reel,
                'url' => $url,
                'relatedReels' => $relatedReels->isEmpty() ? null : $relatedReels,
            ];
            
            return response()->json([
                'status' => 'success',
                'message' => 'Reel and related reels retrieved successfully',
                'data' => $data,
            ], 200);
    
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Internal Server Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function incrementReelViews(Request $request) {
        $reel = Reel::find($request->reel_id);

        if ($reel) {
            // Increment the news's total_views column by 1
            $reel->increment('total_views');

            return response()->json([
                'status' => 'success',
                'message' => 'Views added successfully',
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Reel not found or views could not be added'
            ], 404);
        }
    }

    public function incrementReelFavorite(Request $request) {
        $reel = Reel::find($request->reel_id);

        if ($reel) {
            // Increment the news's favorite_count column by 1
            $reel->increment('favorite_count');

            return response()->json([
                'status' => 'success',
                'message' => 'Favorite added successfully',
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Reel not found or views could not be added'
            ], 404);
        }
    }

}
