<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\NewsFavorite;
use App\Models\Comment;
use DB;
use Auth;

class NewsController extends Controller
{   
    public function searchNews(Request $request) {
        try {
            $limit = $request->input('count', 10);
            $page = $request->input('page', 1); 
            $offset = ($page * $limit) - $limit;

            $query = $request->input('query');

            if (empty($query)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Search query cannot be empty or null',
                ], 400);
            }

            $searchedNews = News::join('languages', 'news.language_id', '=', 'languages.id')
                ->join('categories', 'news.category_id', '=', 'categories.id')
                ->join('locations', 'news.location_id', '=', 'locations.id')
                ->select('news.*', 'languages.name as language_name', 'categories.name as category_name', 'locations.location_name')
                ->where(function ($queryBuilder) use ($query) {
                    $queryBuilder->where('news.title', 'like', '%' . $query . '%')
                        ->orWhere('news.description', 'like', '%' . $query . '%');
                })
                ->where('news.status', 0);
    
            // $searchedNews =  $searchedNews->offset($offset)->limit($limit)->get();
            $searchedNews = $searchedNews->paginate($limit, ['*'], 'page', $page);

            if ($searchedNews->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No news found for the given search query',
                    'data' => $searchedNews,
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'count' => $searchedNews->count(),
                'pages' => $page,
                'message' => 'News retrieved successfully',
                'data' => $searchedNews,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Internal Server Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function getVideos(Request $request) {
        try {
            $limit = $request->input('count', 10);
            $page = $request->input('page', 1); 
            $offset = ($page * $limit) - $limit;

            // Get News Videos Randomly
            $randomVideos = DB::table('news')
                ->join('languages', 'news.language_id', '=', 'languages.id')
                ->join('categories', 'news.category_id', '=', 'categories.id')
                ->join('locations', 'news.location_id', '=', 'locations.id')
                ->select('news.*', 'languages.name as language_name', 'categories.name as category_name', 'locations.location_name')
                // ->where('news.content_type', 4)
                // ->whereNotNull('news.video')
                ->where('news.status', 0)
                ->inRandomOrder();

            $randomVideos =  $randomVideos->offset($offset)->limit($limit)->get();

            if ($randomVideos->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Videos not found',
                ], 404);
            }
    
            return response()->json([
                'status' => 'success',
                'count' => $randomVideos->count(),
                'pages' => $page,
                'message' => 'Videos retrieved successfully',
                'data' => $randomVideos,
            ], 200);
    
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Internal Server Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function getVideoById($id) {
        try {
            $video = DB::table('news')
                ->join('languages', 'news.language_id', '=', 'languages.id')
                ->join('categories', 'news.category_id', '=', 'categories.id')
                ->join('locations', 'news.location_id', '=', 'locations.id')
                ->select('news.*', 'languages.name as language_name', 'categories.name as category_name', 'locations.location_name')
                ->where('news.id', $id)
                ->first();
                
            if (!$video) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Video not found',
                ], 404);
            }

            $relatedVideos = DB::table('news')
                ->join('languages', 'news.language_id', '=', 'languages.id')
                ->join('categories', 'news.category_id', '=', 'categories.id')
                ->join('locations', 'news.location_id', '=', 'locations.id')
                ->select('news.*', 'languages.name as language_name', 'categories.name as category_name', 'locations.location_name')
                ->where('news.category_id', $video->category_id)
                ->where('news.id', '<>', $video->id)
                ->where('news.status', 0)
                ->inRandomOrder()
                ->limit(4)
                ->get();
    
            $data = [
                'video' => $video,
                'relatedVideos' => $relatedVideos->isEmpty() ? null : $relatedVideos,
            ];
            
            return response()->json([
                'status' => 'success',
                'message' => 'Video and related videos retrieved successfully',
                'data' => $data,
            ], 200);
    
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Internal Server Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function getNews(Request $request) {
        try {
            $limit = $request->input('count', 10);
            $page = $request->input('page', 1); 
            $offset = ($page * $limit) - $limit;

            $news = DB::table('news')
                ->join('languages', 'news.language_id', '=', 'languages.id')
                ->join('categories', 'news.category_id', '=', 'categories.id')
                ->join('locations', 'news.location_id', '=', 'locations.id')
                ->select('news.*', 'languages.name as language_name', 'categories.name as category_name', 'locations.location_name')
                ->orderByDesc('news.id') 
                ->where('news.status', 0);
                
            $news =  $news->offset($offset)->limit($limit)->get();

            if (!$news) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'News not found',
                ], 404);
            }
    
            return response()->json([
                'status' => 'success',
                'count' => $news->count(),
                'pages' => $page,
                'message' => 'News retrieved successfully',
                'data' => $news,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Internal Server Error: ' . $e->getMessage(),
            ], 500);
        }
    }
  
    public function getNewsById($id) {
        try {
            $news = DB::table('news')
                ->join('languages', 'news.language_id', '=', 'languages.id')
                ->join('categories', 'news.category_id', '=', 'categories.id')
                ->join('locations', 'news.location_id', '=', 'locations.id')
                ->select('news.*', 'languages.name as language_name', 'categories.name as category_name', 'locations.location_name')
                ->where('news.id', $id)
                ->first();
            
            $comments = Comment::with('user') 
                ->where('news_id', $id)
                ->latest('created_at')
                ->get();
                
            if (!$news) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'News not found',
                ], 404);
            }

            $relatedNews = DB::table('news')
                ->join('languages', 'news.language_id', '=', 'languages.id')
                ->join('categories', 'news.category_id', '=', 'categories.id')
                ->join('locations', 'news.location_id', '=', 'locations.id')
                ->select('news.*', 'languages.name as language_name', 'categories.name as category_name', 'locations.location_name')
                ->where('news.category_id', $news->category_id)
                ->where('news.id', '<>', $news->id) // Exclude the current news
                ->where('news.status', 0)
                ->limit(4)
                ->get();

            $url = url()->current();

            $data = [
                'news' => $news,
                'url' => $url,
                'comments' => $comments,
                'relatedNews' => $relatedNews->isEmpty() ? null : $relatedNews,
            ];
            
            return response()->json([
                'status' => 'success',
                'message' => 'News retrieved successfully',
                'data' => $data,
            ], 200);
    
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Internal Server Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function getNewsByCategory(Request $request, $category_id) {
        try {
            $limit = $request->input('count', 10);
            $page = $request->input('page', 1); 
            $offset = ($page * $limit) - $limit;

            $news = DB::table('news')
                ->join('languages', 'news.language_id', '=', 'languages.id')
                ->join('categories', 'news.category_id', '=', 'categories.id')
                ->join('locations', 'news.location_id', '=', 'locations.id')
                ->select('news.*', 'languages.name as language_name', 'categories.name as category_name', 'locations.location_name')
                ->where('news.category_id', $category_id)
                ->where('news.status', 0);
          
            // $news =  $news->offset($offset)->limit($limit)->get();
            $news = $news->paginate($limit, ['*'], 'page', $page);

            if ($news->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'News not found for this category',
                    'data' => $news,
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'count' => $news->count(),
                'pages' => $page,
                'message' => 'News retrieved successfully',
                'data' => $news,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Internal Server Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function getRecentNews(Request $request) {
        try {
            $limit = $request->input('count', 10);
            $page = $request->input('page', 1); 
            $offset = ($page * $limit) - $limit;

            $recentNews = DB::table('news')
                ->join('languages', 'news.language_id', '=', 'languages.id')
                ->join('categories', 'news.category_id', '=', 'categories.id')
                ->join('locations', 'news.location_id', '=', 'locations.id')
                ->select('news.*', 'languages.name as language_name', 'categories.name as category_name', 'locations.location_name')
                ->where('news.status', 0) 
                ->orderByDesc('news.id');
            
            $recentNews =  $recentNews->offset($offset)->limit($limit)->get();

            if ($recentNews->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Recent News not found',
                ], 404);
            }
    
            return response()->json([
                'status' => 'success',
                'count' => $recentNews->count(),
                'pages' => $page,
                'message' => 'Recent News retrieved successfully',
                'data' => $recentNews,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Internal Server Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function getPopularNews(Request $request) {
        try {
            $limit = $request->input('count', 10);
            $page = $request->input('page', 1); 
            $offset = ($page * $limit) - $limit;

            $popularNews = DB::table('news')
                ->join('languages', 'news.language_id', '=', 'languages.id')
                ->join('categories', 'news.category_id', '=', 'categories.id')
                ->join('locations', 'news.location_id', '=', 'locations.id')
                ->select('news.*', 'languages.name as language_name', 'categories.name as category_name', 'locations.location_name')
                ->where('news.status', 0) 
                ->where('news.total_views', '>', 0)
                ->orderByDesc('news.total_views'); 
     
            $popularNews =  $popularNews->offset($offset)->limit($limit)->get();

            if ($popularNews->isEmpty()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Popular News not found',
                ], 404);
            }
    
            return response()->json([
                'status' => 'success',
                'count' => $popularNews->count(),
                'pages' => $page,
                'message' => 'Popular News retrieved successfully',
                'data' => $popularNews,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Internal Server Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function incrementNewsViews(Request $request) {
        $news = News::find($request->news_id);

        if ($news) {
            // Increment the news's total_views column by 1
            $news->increment('total_views');

            return response()->json([
                'status' => 'success',
                'message' => 'Views added successfully',
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'News not found or views could not be added'
            ], 404);
        }
    }

    public function incrementNewsFavorite(Request $request) {
        $news = News::find($request->news_id);

        if ($news) {
            // Increment the news's favorite_count column by 1
            $news->increment('favorite_count');

            return response()->json([
                'status' => 'success',
                'message' => 'Favorite added successfully',
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'News not found or views could not be added'
            ], 404);
        }
    }

    public function favorite($newsId) {
        $userId = Auth::id();

        $existingFavorite = NewsFavorite::where('user_id', $userId)
            ->where('news_id', $newsId)
            ->first();

        if ($existingFavorite) {
            // Remove favorite
            $existingFavorite->delete();
            $news = News::find($newsId);
            $news->favorite_count -= 1; // Update favorite_count
            $news->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Removed favorite'
            ], 200);
        } else {
            // Add favorite
            NewsFavorite::create(['user_id' => $userId, 'news_id' => $newsId]);
            $news = News::find($newsId);
            $news->favorite_count += 1; // Update favorite_count
            $news->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Added favorite',
            ], 200);
        }
    }





}
