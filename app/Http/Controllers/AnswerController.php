<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\PostComment;
use App\Models\Question;
use App\Models\QuestionAnswerLike;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{
    public function answer($id){
        $quationobj = new Question();
        $answerobj = new Answer();

        $questions = $quationobj
            ->join('categories', 'categories.id', '=', 'questions.category_id')
            ->join('users', 'users.id', '=', 'questions.user_id')
            ->select('questions.*', 'categories.name as category_name', 'users.name as user_name', 'users.image as user_image')
            ->where('questions.id', $id)
            ->first();

        $answers = $answerobj

        ->join('users', 'users.id','=', 'answers.user_id')
        ->select('answers.*', 'users.name as user_name', 'users.image as user_image')
        ->where('answers.question_id', $id)
        ->orderby('answers.id', 'desc')
        ->get();

        return view('user.answer', compact('questions', 'answers'));
    }

    public function answer_store(Request $request, $id){
        $request->validate([
            
            'answer' => 'required',
        ]);
       $data=[
            'user_id' => auth()->user()->id,
            'question_id'=> $id,
            'answer'=>$request->answer,

       ];
       Answer::create($data);

        $notifacation = [
            'message' => 'Data Insert Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notifacation);

        
    }

    public function answers_distroy($id)
    {
        Answer::find($id)->delete();


        $notifacation = [
            'message' => 'Answer Deleted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notifacation);
    }

    // LIKE AND UNLIKE
    public function quation_answers_like($id){
        $data = [
            'user_id' => auth()->user()->id,
            'answer_id'=>$id
        ];

        QuestionAnswerLike::create($data);
        return redirect()->back();
    }

    public function quation_answers_unlike($id){
        QuestionAnswerLike::where('answer_id', $id)->where('user_id', auth()->user()->id)->delete();
        return redirect()->back();

    }
}
