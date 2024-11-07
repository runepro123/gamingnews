<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\Category;
use Validator;
use DB;

class CategoryController extends Controller
{
    public function categoryList() {
        $data['headerTitle'] = 'Category List';
        $data['categories'] = DB::table('categories')
                                    ->join('languages', 'categories.language_id', '=', 'languages.id')
                                    ->select('categories.*', 'languages.name as language_name')
                                    ->orderByDesc('categories.id') 
                                    ->get();

        return view('backend.admin.categories.index', $data);
    }

    public function add() {
        $data['headerTitle'] = 'Add New Category';
        $data['languages'] = Language::where('status', 0)->get();

        return view('backend.admin.categories.add', $data);
    }

    public function insert(Request $request) {
        $rules = [
            'name' => 'required',
            'language_id' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ];

        $customMessage = [
            'language_id.required' => 'Please select a language.',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessage);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $image = $request->file('image');
        $imageName = $image->getClientOriginalName();
        $timestamp = now()->timestamp; // Get the current 
        $directory = 'backend/uploads/category-images/';
        $imageUrl = $directory . $timestamp . '_' . $imageName; // Add timestamp to the filename
        $image->move(public_path($directory), $timestamp . '_' . $imageName);

        $category = new Category;

        $category->name = $request->name;
        $category->language_id = $request->language_id;
        $category->image = $imageUrl;
        $category->save();

        return redirect('category/list')->with("success", "Category successfully added.");
    }

    public function edit($id) {
        $data['languages'] = Language::where('status', 0)->get();
        $data['category'] = Category::find($id);

        if(!empty($data['category'])) {
            $data['headerTitle'] = 'Edit Category';

            return view('backend.admin.categories.edit', $data);
        }else {
            abort(404);
        }
    }
    
    public function update(Request $request) {
        $request->validate([
            'name' => 'required',
            'image' => $request->has('image') ? 'required|image|mimes:jpeg,png,jpg,gif,svg' : 'nullable',
        ]);
    
        $image = $request->file('image');  
        
        $category = Category::find($request->category_id);
        
        if(!empty($image)) {
            if ($category->image && file_exists(public_path($category->image))) {
                unlink(public_path($category->image));
            }
            $imageName = $image->getClientOriginalName();
            $timestamp = now()->timestamp; // Get the current 
            $directory = 'backend/uploads/category-images/';
            $imageUrl = $directory . $timestamp . '_' . $imageName; // Add timestamp to the filename
            $image->move(public_path($directory), $timestamp . '_' . $imageName);
            $category->image = $imageUrl;
        }

        $category->name = $request->name;
        $category->language_id = $request->language_id;
        $category->status = $request->status;
        $category->save();
      
        return redirect('category/list')->with("success", "Category successfully updated.");
    }

    public function delete($id) {
        $category = Category::find($id);
    
        if (!empty($category)) {
            try {
                if ($category->image && file_exists(public_path($category->image))) {
                    unlink(public_path($category->image));
                }

                $category->delete();
                return redirect('category/list')->with("success", "Category successfully deleted.");
            } catch (\Exception $e) {
                return redirect('category/list')->with("error", "Error deleting category: " . $e->getMessage());
            }
        } else {
            abort(404);
        }
    }

}
