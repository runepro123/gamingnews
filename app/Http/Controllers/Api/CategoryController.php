<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class CategoryController extends Controller
{
    public function getCategory(Request $request, $id = null) {
        try {
            if ($id === null) {
                $limit = $request->input('count', 10);
                $page = $request->input('page', 1); 
                $offset = ($page * $limit) - $limit;

                $categories = DB::table('categories')
                    ->join('languages', 'categories.language_id', '=', 'languages.id')
                    ->select('categories.*', 'languages.name as language_name')
                    ->where('categories.status', 0)
                    ->orderByDesc('categories.id');

                $categories =  $categories->offset($offset)->limit($limit)->get();

                if ($categories->isEmpty()) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Categories not found',
                    ], 404);
                }

                return response()->json([
                    'status' => 'success',
                    'count' => $categories->count(),
                    'pages' => $page,
                    'message' => 'Categories retrieved successfully',
                    'data' => $categories,
                ], 200);

            } else {
                $category = DB::table('categories')
                    ->join('languages', 'categories.language_id', '=', 'languages.id')
                    ->select('categories.*', 'languages.name as language_name')
                    ->where('categories.id', $id)
                    ->first();
    
                if (!$category) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Category not found',
                    ], 404);
                }
    
                return response()->json([
                    'status' => 'success',
                    'message' => 'Category retrieved successfully',
                    'data' => $category,
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Internal Server Error: ' . $e->getMessage(),
            ], 500);
        }
    }


}
