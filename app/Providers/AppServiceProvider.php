<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;
use App\Models\News;
use App\Models\WebConfiguration;
use App\Models\SocialConfiguration;
use App\Models\Ad;
use App\Models\Page;
use App\Models\MailConfiguration;
use DB;
use App\Models\Category;
use App\Models\Language;
use App\Models\BreakingNews;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share Dynamic Pages
        View::share('pages', Page::get());
        // Share Web Configuration data
        View::share('webConfiguration', WebConfiguration::first());
        // Share Social Configuration data
        View::share('socials', SocialConfiguration::get());
        // Share Social Configuration data
        View::share('ads', Ad::first());
        // Shere MailConfiguration
        View::share('mailConfiguration', MailConfiguration::first());
        // Share popularNews with all views
        View::share('popularNews', News::select('id', 'title', 'featured_image', 'created_at')
            ->where('status', 0)
            ->where('total_views', '>', 0)
            ->orderByDesc('total_views')
            ->limit(6)
            ->get()
        );

        // Share categoriesWithCount on dashboard page for Category Wise News chart
        View::share('categoriesWithCount', Category::leftJoin('news', 'categories.id', '=', 'news.category_id')
            ->where('categories.language_id', 8) // Language ID 8 is for English
            ->select('categories.id', 'categories.name', DB::raw('COUNT(news.id) as post_count'))
            ->groupBy('categories.id', 'categories.name')
            ->get());

        // Share languageWiseNews on dashboard page for Language Wise News chart
        View::share('languageWiseNews', Language::leftJoin('news', 'languages.id', '=', 'news.language_id')
            ->select('languages.id', 'languages.name', DB::raw('COUNT(news.id) as post_count'))
            ->groupBy('languages.id', 'languages.name') 
            ->get());


        // Share trendingTitle with all views
        View::share('trendingTitle', News::select('title')
            ->where('status', 0)
            ->where('created_at', '>=', now()->startOfDay()) // Filter by today's news
            ->where('total_views', '>', 0)
            ->orderByDesc('total_views')
            ->limit(1)
            ->value('title') // Get only the 'title' column
        );

        // Share trenbreakingNewsList with all views
        View::share('breakingNewsList', BreakingNews::with('news')
               ->where('status', 0) 
                ->get()
        );
    }
}
