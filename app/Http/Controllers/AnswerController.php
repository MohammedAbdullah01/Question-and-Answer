<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'question_id' =>['required' , 'int' , 'exists:questions,id'],
            'title'       =>['required' , 'string' , 'min:4']
        ]);
        
        $answer = new Answer();
        $answer->question_id = $request->input('question_id');
        $answer->user_id     = auth()->id();
        $answer->title       = $request->input('title');
        $answer->save();
        return redirect()->back();
    }

    public function bestAnswer(Request $request ,  $id)
    {
        $answer = Answer::findOrfail($id);
        $question = $answer->question;
        if($question->user_id == Auth::id()){

            $question->answers()->update([
                'best_answer' => 0 
            ]);
            
            $answer->best_answer = 1;
            $answer->save();
            return redirect()->back();

        }else{
            return abort(403);
        }
    }
}
