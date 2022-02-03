<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class QuestionController extends Controller
{
    public function index()
    {
        
        $search = request('search');
        $questions = Question::with('user' , 'tags' )->withCount('answers')->latest()
        ->when($search , function($query , $search){
            $query->where('title' , 'LIKE' , '%'. $search .'%');
        }) 
        ->paginate(10);
        // dd($questions);
        return view('questions.questions_all' , compact('questions'));
    }

    public function create()
    {
            $tags = Tag::all();
            return view('questions.create_question' ,compact('tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required' , 'min:5', 'string'],
            'name' =>  [  'array'] // Tags
        ]);
        $request->merge([
            'user_id' => Auth::id()
        ]);
        
        $question = Question::create($request->all());
        $question->tags()->attach($request->input('name'));
        return redirect()->route('questions.all');
    }

    public function show($id)
    {
        $question = Question::findOrfail($id);
        $answers  =  $question->answers()->with('user')->latest()->get();
        return view('questions.show_question' , compact('question' , 'answers' ));
    }

    public function edit($id)
    {
        $question = Question::findOrfail($id);
        $tags = Tag::all();
        $question_tag = $question->tags()->pluck('id')->toArray();
        return view('questions.edit_question' , compact('question' , 'tags' , 'question_tag'));
    }

    public function update(Request $request , $id)
    {
        $request->validate([
            'title' => ['required' , 'min:5', 'string'],
            'name' =>  ['array'] // Tags
        ]);

        $question = Question::findOrfail($id);
        $question->update($request->all());
        $question->tags()->sync($request->input('name'));
        return redirect()->route('show.question',$id);
    }

    public function delete($id)
    {
        $question = Question::findOrfail($id);
        $question->delete();
        return redirect()->route('questions.all');
    }
}
