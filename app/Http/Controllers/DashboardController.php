<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Admin;
use App\Models\Category;
use App\Models\News;
use App\Models\BreakingNews;
use App\Models\Reel;
use App\Models\Slider;
use App\Models\Language;
use App\Models\Location;
use App\Models\Tag;
use App\Models\User;
use App\Models\Page;
use App\Models\Email;

class DashboardController extends Controller
{
    public function dashboard() {
        if (Auth::guard('admin')->check()) {
            $data = [
                'headerTitle' => 'Dashboard',
            ];

            $data['totalCategories'] = Category::count();
            $data['totalNews'] = News::count();
            $data['totalBreakingNews'] = BreakingNews::count();
            $data['totalReels'] = Reel::count();
            $data['totalSliders'] = Slider::count();
            $data['totalLanguages'] = Language::count();
            $data['totalLocations'] = Location::count();
            $data['totalTags'] = Tag::count();
            $data['totalAdmins'] = Admin::count();
            $data['totalUsers'] = User::count();
            $data['totalUPages'] = Page::count();
            $data['totalEmails'] = Email::count();
            
            return view('backend.admin.dashboard', $data);
        }
    }
    

}
