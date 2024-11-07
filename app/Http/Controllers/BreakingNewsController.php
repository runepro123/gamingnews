<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\BreakingNews;
use App\Models\News;
use Carbon\Carbon;
use Validator;
use DB;

class BreakingNewsController extends Controller
{
    public function breakingNewsList() {
        $data['headerTitle'] = 'Breaking News List';
        $data['breakingNewsList'] = BreakingNews::with('news')
                                ->where('status', 0) 
                                ->get();

        return view('backend.admin.breaking-news.index', $data);
    }

    public function add() {
        $data['headerTitle'] = 'Add New Breaking News';

        // Retrieve news from the last 24 hours
        $data['newsFromLast24Hours'] = News::where('created_at', '>=', Carbon::now()->subDay())
                                            ->get();

        return view('backend.admin.breaking-news.add', $data);
    }

    public function insert(Request $request) {
        $rules = [
            'news_id' => 'required',
        ];

        $customMessage = [
            'news_id.required_if' => 'Select a news title',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessage);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $breakingNews = new BreakingNews();

        $breakingNews->news_id = $request->input('news_id');
        $breakingNews->save();

        return redirect('breaking-news/list')->with("success", "Breaking News successfully added.");
    }

    public function edit($id) {
        $data['breakingNews'] = BreakingNews::find($id);

        if(!empty($data['breakingNews'])) {
            $data['headerTitle'] = 'Edit Breaking News';

            return view('backend.admin.breaking-news.edit', $data);
        }else {
            abort(404);
        }
    }

    public function update(Request $request) {
        $breakingNews = BreakingNews::find($request->breaking_news_id);

        if (!$breakingNews) {
            return redirect('breaking-news/list')->with("error", "Breaking news not found.");
        }

        $breakingNews->status = $request->status;
        $breakingNews->save();

        return redirect('breaking-news/list')->with("success", "Breaking news successfully updated.");
    }


    public function delete($id) {
        $breakingNews = BreakingNews::find($id);
    
        if (!empty($breakingNews)) {
            $breakingNews->delete();

            return redirect('breaking-news/list')->with("success", "Breaking news successfully deleted.");

        } 

    }

}
