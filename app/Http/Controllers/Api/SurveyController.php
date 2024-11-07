<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Survey;
use App\Models\Option;
use Validator;

class SurveyController extends Controller
{
    public function getSurvey() {
        $survey = Survey::with('options', 'language')
                ->orderBy('created_at', 'desc')
                ->get();

        if (!$survey) {
            return response()->json([
                'status' => 'error',
                'message' => 'Survey not found',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Survey retrieved successfully',
            'data' => $survey,
        ], 200);

    }

    public function submitVote(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'survey_id' => 'required|exists:surveys,id',
                'option_id' => 'required|exists:options,id',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 422);
            }

            $survey = Survey::findOrFail($request->input('survey_id'));
            $option = Option::findOrFail($request->input('option_id'));

            $option->increment('counter');

            return response()->json([
                'status' => 'success',
                'message' => 'Vote added submitted',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error submitting the vote',
            ], 500);
        }
    }

    
}
