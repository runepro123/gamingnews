<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\Tag;
use Validator;
use DB;

class TagController extends Controller
{
    public function tagList() {
        $data['headerTitle'] = 'Tag List';
        $data['tags'] = DB::table('tags')
                                    ->join('languages', 'tags.language_id', '=', 'languages.id')
                                    ->select('tags.*', 'languages.name as language_name')
                                    ->orderByDesc('tags.id') 
                                    ->get();

        return view('backend.admin.tags.index', $data);
    }

    public function add() {
        $data['headerTitle'] = 'Add New Tag';
        $data['languages'] = Language::where('status', 0)->get();

        return view('backend.admin.tags.add', $data);
    }

    public function insert(Request $request) {
        $rules = [
            'name' => 'required',
            'language_id' => 'required',
        ];

        $customMessage = [
            'language_id.required' => 'Please select a language.',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessage);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $tag = new Tag;
        $tag->name = $request->name;
        $tag->language_id = $request->language_id;
        $tag->save();

        return redirect('tag/list')->with("success", "Tag successfully added.");
    }

    public function edit($id) {
        $data['languages'] = Language::get();
        $data['tag'] = Tag::find($id);

        if(!empty($data['tag'])) {
            $data['headerTitle'] = 'Edit Tag';

            return view('backend.admin.tags.edit', $data);
        }else {
            abort(404);
        }
    }

    public function update(Request $request) {
        $request->validate([
            'name' => 'required',
        ]);

        $tag = Tag::find($request->tag_id);
        $tag->name = $request->name;
        $tag->language_id = $request->language_id;
        $tag->status = $request->status;
        $tag->save();

        return redirect('tag/list')->with("success", "Tag successfully updated.");
    }

    public function delete($id) {
        $tag = Tag::find($id);
    
        if (!empty($tag)) {
            $tag->delete();
            
            return redirect('tag/list')->with("success", "Tag successfully deleted.");
        } else {
            abort(404);
        }
    }

}
