<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use DB;
use App\Models\Language;
use Validator;

class PageController extends Controller
{
    public function showDynamicPage($slug) {
        $data['page'] = Page::where('slug', $slug)->first();

        if (!empty($data['page'])) {
            return view('frontend.pages.page', $data);
        } else {
            abort(404);
        }
    }

    public function pageList() {
        $data['headerTitle'] = "Page List";
        $data['pages'] = DB::table('pages')
                                ->join('languages', 'pages.language_id', '=', 'languages.id')
                                ->select('pages.*', 'languages.name as language_name')
                                ->orderByDesc('pages.id') 
                                ->get();
        return view('backend.admin.pages.index', $data);
    }

    public function add() {
        $data['headerTitle'] = 'Add New Page';
        $data['languages'] = Language::where('status', 0)->get();

        return view('backend.admin.pages.add', $data);
    }

    public function insert(Request $request) {
        $rules = [
            'title' => 'required',
            'slug' => 'required',
            'meta_description' => 'required',
            'meta_keywords' => 'required',
            'language_id' => 'required',
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'page_content' => 'required',
        ];

        $customMessage = [
            'language_id.required' => 'Please select a language.',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessage);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $icon = $request->file('icon');
        $iconName = $icon->getClientOriginalName();
        $timestamp = now()->timestamp; // Get the current 
        $directory = 'backend/uploads/page-icons/';
        $iconUrl = $directory . $timestamp . '_' . $iconName; // Add timestamp to the filename
        $icon->move(public_path($directory), $timestamp . '_' . $iconName);

        $page = new Page;

        $page->title = $request->title;
        $page->slug = $request->slug;
        $page->meta_description = $request->meta_description;
        $page->meta_keywords = $request->meta_keywords;
        $page->page_content = $request->page_content;
        $page->language_id = $request->language_id;
        $page->icon = $iconUrl;
        $page->save();

        return redirect('page/list')->with("success", "Page successfully added.");
    }

    public function edit($id) {
        $data['languages'] = Language::where('status', 0)->get();
        $data['page'] = Page::find($id);

        if(!empty($data['page'])) {
            $data['headerTitle'] = 'Edit Page';

            return view('backend.admin.pages.edit', $data);
        }else {
            abort(404);
        }
    }

    public function update(Request $request) {
        $request->validate([
            'title' => 'required',
            'slug' => 'required',
            'meta_description' => 'required',
            'meta_keywords' => 'required',
            'icon' => $request->has('icon') ? 'required|image|mimes:jpeg,png,jpg,gif,svg' : 'icon',
            'page_content' => 'required',
        ]);
    
        $icon = $request->file('icon');  
        
        $page = Page::find($request->page_id);
        
        if(!empty($icon)) {
            if ($page->icon && file_exists(public_path($page->icon))) {
                unlink(public_path($page->icon));
            }
            $iconName = $icon->getClientOriginalName();
            $timestamp = now()->timestamp; // Get the current 
            $directory = 'backend/uploads/page-icons/';
            $iconUrl = $directory . $timestamp . '_' . $iconName; // Add timestamp to the filename
            $icon->move(public_path($directory), $timestamp . '_' . $iconName);
            $page->icon = $iconUrl;
        }

        $page->title = $request->title;
        $page->slug = $request->slug;
        $page->meta_description = $request->meta_description;
        $page->meta_keywords = $request->meta_keywords;
        $page->page_content = $request->page_content;
        $page->language_id = $request->language_id;
        $page->status = $request->status;
        $page->save();
      
        return redirect('page/list')->with("success", "Page data successfully updated.");
    }

    public function delete($id) {
        $page = Page::find($id);
    
        if (!empty($page)) {
            try {
                if ($page->icon && file_exists(public_path($page->icon))) {
                    unlink(public_path($page->icon));
                }

                $page->delete();
                return redirect('page/list')->with("success", "Page successfully deleted.");
            } catch (\Exception $e) {
                return redirect('page/list')->with("error", "Error deleting page: " . $e->getMessage());
            }
        } else {
            abort(404);
        }
    }
}
