<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{
    public function getPages() {
        try {
            $pages =  Page::latest()->get();

            if ($pages->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Page not found',
                ], 404);
            }
    
            return response()->json([
                'status' => 'success',
                'message' => 'Pages retrieved successfully',
                'data' => $pages,
            ], 200);
    
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Internal Server Error: ' . $e->getMessage(),
            ], 500);
        }
    }
    public function getPagesContent($slug) {
        try {
            $pageContent = Page::where('slug', $slug)->first();

            if (!$pageContent) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Page content not found',
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Pages content retrieved successfully',
                'data' => $pageContent,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Internal Server Error: ' . $e->getMessage(),
            ], 500);
        }
    }

}
