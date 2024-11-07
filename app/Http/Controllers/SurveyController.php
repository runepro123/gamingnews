<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Survey;
use App\Models\Option;
use App\Models\Language;
use Validator;

class SurveyController extends Controller
{
    public function submitVote(Request $request)
    {
        try {
            $request->validate([
                'survey_id' => 'required|exists:surveys,id',
                'option_id' => 'required|exists:options,id',
            ]);
    
            $survey = Survey::findOrFail($request->input('survey_id'));
            $option = Option::findOrFail($request->input('option_id'));
    
            $option->increment('counter');
    
            return redirect()->back()->with('success', 'Vote submitted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error submitting the vote.');
        }
    }

    public function surveyList() {
        $data['headerTitle'] = 'Survey List';
        $data['surveys'] = Survey::with('options', 'language')
                                    ->orderBy('created_at', 'desc')
                                    ->get();

        return view('backend.admin.surveys.index', $data);
    }

    public function showAddSurveyForm() {
        $data['headerTitle'] = 'Add New Survey';
        $data['languages'] = Language::where('status', 0)->get();

        return view('backend.admin.surveys.add', $data);
    }

    public function addSurvey(Request $request) {
        try {
            $rules = [
                'language_id' => 'required',
                'question' => 'required',
                'options' => 'required|array',
                'options.*' => 'required|string|max:255',
            ];
    
            $customMessage = [
                'language_id.required' => 'Please select a language.',
            ];
    
            $validator = Validator::make($request->all(), $rules, $customMessage);
    
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Save question
            $survey = new Survey();
            $survey->language_id = $request->input('language_id');
            $survey->question = $request->input('question');
            $survey->save();
        
            // Save options
            foreach ($request->input('options') as $optionValue) {
                $option = new Option();
                $option->survey_id = $survey->id;
                $option->option = $optionValue;
                $option->save();
            }

            return redirect('survey/list')->with("success", "Survey successfully added.");

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating the product.');
        }
    }

    public function viewOptions($id)
    {
        $survey = Survey::findOrFail($id);
        $options = $survey->options;

        return view('backend.admin.surveys.view-options', compact('survey', 'options'));
    }

    public function addOption(Request $request, $surveyId)
    {
        try {
            $request->validate([
                'option' => 'required|string|max:255',
            ]);

            $survey = Survey::findOrFail($surveyId);

            $option = new Option();
            $option->survey_id = $survey->id;
            $option->option = $request->input('option');
            $option->counter = 0; 
            $option->save();

            return redirect()->back()->with('success', 'Option added successfully.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error adding the option.');
        }
    }

    public function updateOption(Request $request, $id)
    {
        try {
            $request->validate([
                'option' => 'required|string|max:255',
            ]);

            $option = Option::findOrFail($id);
            $option->option = $request->input('option');
            $option->save();

            return redirect()->back()->with('success', 'Option updated successfully.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating the option.');
        }
    }

    public function deleteOption($id)
    {
        try {
            $option = Option::findOrFail($id);
            $option->delete();

            return redirect()->back()->with('success', 'Option deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting the option.');
        }
    }

    public function showEditSurveyForm($id) {
        $data['headerTitle'] = 'Edit Survey';
        $data['languages'] = Language::where('status', 0)->get();
        $data['survey'] = Survey::findOrFail($id);

        return view('backend.admin.surveys.edit', $data);
    }

    public function updateSurvey(Request $request, $id) {
        try {
            $rules = [
                'language_id' => 'required',
                'question' => 'required',
                'status' => 'required|in:0,1',
            ];

            $customMessage = [
                'language_id.required' => 'Please select a language.',
            ];

            $validator = Validator::make($request->all(), $rules, $customMessage);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $survey = Survey::findOrFail($id);

            $survey->language_id = $request->input('language_id');
            $survey->question = $request->input('question');
            $survey->status = $request->input('status');
            $survey->save();

            return redirect('survey/list')->with('success', 'Survey updated successfully.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating the survey.');
        }
    }
    
    public function deleteSurvey($id) {
        try {
            $survey = Survey::findOrFail($id);

            // Delete related options
            $survey->options()->delete();

            $survey->delete();

            return redirect('survey/list')->with('success', 'Survey deleted successfully.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting the survey.');
        }
    }
}
