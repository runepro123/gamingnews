<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Slider;
use App\Models\Category;
use App\Models\ContactConfiguration;
use App\Models\Comment;
use App\Models\Reel;
use App\Models\Survey;
use App\Models\Option;
use DB;
use Embed\Embed;

class NewsAppController extends Controller
{
    public function index() {
        $data['categories'] = Category::where('language_id', 8)->get(); //Language ID 8 is for English

        $data['slider'] = DB::table('sliders')
            ->join('categories', 'sliders.category_id', '=', 'categories.id')
            ->select('sliders.*', 'categories.name as category_name')
            ->where('sliders.status', 0)
            ->orderByDesc('sliders.id') 
            ->limit(3)
            ->get();

        $data['recentNews'] = DB::table('news')
            ->join('categories', 'news.category_id', '=', 'categories.id')
            ->select('news.*', 'categories.name as category_name')
            ->where('news.status', 0)
            ->orderByDesc('news.id') 
            ->limit(6)
            ->get();

        $data['popularNews'] = DB::table('news')
            ->join('categories', 'news.category_id', '=', 'categories.id')
            ->select('news.*', 'categories.name as category_name')
            ->where('news.status', 0)
            ->where('news.total_views', '>', 0)
            ->orderByDesc('news.total_views')
            ->limit(6)
            ->get();
        
        // 2 random news from the last 10 news
        $data['randomNews'] = DB::table('news')
            ->join('categories', 'news.category_id', '=', 'categories.id')
            ->select('news.*', 'categories.name as category_name')
            ->where('news.status', 0)
            ->orderByDesc('news.id')
            ->limit(10)
            ->inRandomOrder() // Add this line to get random order
            ->limit(2)        // Limit to 2 records
            ->get();

        $data['reels'] = Reel::latest()->limit(50)->inRandomOrder()->get();

        $data['surveys'] = Survey::with('options', 'language')
                            ->orderBy('created_at', 'desc')
                            ->get();

        return view('frontend.home.home', $data);

    }

    public function getCategories() {
        $data['categories'] = Category::where('language_id', 8)->get(); //Language ID 8 is for English

        return view('frontend.category.categories', $data);
    }

    public function getNewsByCategory($id) {
        $categoryId = $id;
        $data['categoryName'] = '';

        if ($categoryId) {
            $category = Category::find($categoryId);
            if ($category) {
                $data['categoryName'] = $category->name;
            }
        }

        $data['categoryId'] = $categoryId;
        return view('frontend.news.category-news', $data);
    }

    public function getLatestNews() {
        $data['categories'] = Category::where('language_id', 8)->get(); //Language ID 8 is for English

        return view('frontend.news.latest-news', $data);
    }

    public function getSliderDetails($id) {
        // Fetch news details
        $sliderDetails = DB::table('sliders')
            ->join('categories', 'sliders.category_id', '=', 'categories.id')
            ->select('sliders.*', 'categories.name as category_name')
            ->where('sliders.id', $id)
            ->first();

        $comments = Comment::where('slider_id', $id)->latest('created_at')->get();

        $prevSlider = Slider::where('id', '<', $id)->orderBy('id', 'desc')->first();
        $nextSlider = Slider::where('id', '>', $id)->orderBy('id', 'asc')->first();

        $relatedSliders = DB::table('sliders')
                ->join('languages', 'sliders.language_id', '=', 'languages.id')
                ->join('categories', 'sliders.category_id', '=', 'categories.id')
                ->select('sliders.*', 'sliders.image as featured_image', 'languages.name as language_name', 'categories.name as category_name')
                ->where('sliders.category_id', $sliderDetails->category_id)
                ->where('sliders.id', '<>', $sliderDetails->id) 
                ->where('sliders.status', 0)
                ->limit(4)
                ->get();
    
        // Fetch categories and count of posts in each category
        $categoriesWithCount = DB::table('categories')
            ->leftJoin('news', 'categories.id', '=', 'news.category_id')
             ->where('categories.language_id', 8) //Language ID 8 is for English
            ->select('categories.id', 'categories.name', DB::raw('COUNT(news.id) as post_count'))
            ->groupBy('categories.id', 'categories.name')
            ->get();
        
        $embed = new Embed();

        $info = null;
        if($sliderDetails->youtube_url) {
            $info = $embed->get($sliderDetails->youtube_url);
        }

        return view('frontend.slider.slider-details', [
            'sliderDetails' => $sliderDetails,
            'info' => $info,
            'prevSlider' => $prevSlider,
            'nextSlider' => $nextSlider,
            'relatedSliders' => $relatedSliders,
            'categoriesWithCount' => $categoriesWithCount,
            'comments' => $comments,
        ]);
    }

    public function getNewsDetails($id) {
        // Fetch news details
        $newsDetails = DB::table('news')
            ->join('categories', 'news.category_id', '=', 'categories.id')
            ->select('news.*', 'categories.name as category_name')
            ->where('news.id', $id)
            ->first();

        $comments = Comment::where('news_id', $id)->latest('created_at')->get();

        // Retrieve the previous and next posts
        $prevNews = News::where('id', '<', $id)->orderBy('id', 'desc')->first();
        $nextNews = News::where('id', '>', $id)->orderBy('id', 'asc')->first();

        $relatedNews = News::select('id', 'title', 'featured_image', 'created_at')
            ->where('news.category_id', $newsDetails->category_id)
            ->where('news.id', '<>', $newsDetails->id) // Exclude the current news
            ->where('status', 0)
            ->limit(4)
            ->get();

        // Fetch categories and count of posts in each category
        $categoriesWithCount = DB::table('categories')
            ->leftJoin('news', 'categories.id', '=', 'news.category_id')
             ->where('categories.language_id', 8) //Language ID 8 is for English
            ->select('categories.id', 'categories.name', DB::raw('COUNT(news.id) as post_count'))
            ->groupBy('categories.id', 'categories.name')
            ->get();
        // dd($comments);

        $embed = new Embed();
        
        $info = null;
        if($newsDetails->youtube_url) {
            $info = $embed->get($newsDetails->youtube_url);
        }

        return view('frontend.news.news-details', [
            'newsDetails' => $newsDetails,
            'info' => $info,
            'prevNews' => $prevNews,
            'nextNews' => $nextNews,
            'relatedNews' => $relatedNews,
            'categoriesWithCount' => $categoriesWithCount,
            'comments' => $comments,
        ]);
    }  
    
    public function searchNews(Request $request) {
        $query = '';
        $query  = $request->input('query');

        return view('frontend.search.search-news', ['query' => $query]);
    }

    public function contact() {
        $contact = ContactConfiguration::first();

        return view('frontend.contact.contact', ['contact' => $contact]);
    }
}
