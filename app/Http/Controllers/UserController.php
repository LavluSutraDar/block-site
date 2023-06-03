<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\PostComment;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function index()
    {
        //$post = Post::all()->where('status',1)->sortByDesc('created_at');

        $postjoin = new Post();

        $posts = $postjoin
            ->join('categories', 'categories.id', '=', 'posts.category_id')
            ->select('posts.*', 'categories.name as category_name')
            ->where('posts.status', 1)
            ->orderby('posts.id', 'desc')
            ->paginate(3);
        $categories = Category::all();
        return view('user.index', compact('posts', 'categories'));
    }

    public function single_post_view($id)
    {

        $postjoin = new Post();

        $post = $postjoin
            ->join('categories', 'categories.id', '=', 'posts.category_id')
            ->select('posts.*', 'categories.name as category_name')
            ->where('posts.id', $id)
            ->first();
        //$comments = PostComment::where('post_id', $id)->get();

        // JOIN wITH COMMENT TABLE AND USER TABLE
        $commentobj = new PostComment();
        $comments = $commentobj->join('users', 'users.id', '=', 'post_comments.user_id')
            ->select('post_comments.*', 'users.name as user_name', 'users.image as user_image')
            ->where('post_comments.post_id', $id)
            ->paginate(5);

        return view('user.single_post_view', compact('post', 'comments'));
    }

    public function filter_by_category($id)
    {
        $postjoin = new Post();

        $postjoin = new Post();
        $posts = $postjoin->join('categories', 'categories.id', '=', 'posts.category_id')
            ->select('posts.*', 'categories.name as category_name')
            ->where('posts.status', 1)
            ->where('posts.category_id', $id)
            ->orderby('posts.id', 'desc')
            ->get();

        $filter_posts = $postjoin
            ->join('categories', 'categories.id', '=', 'posts.category_id')
            ->select('posts.*', 'categories.name as category_name')
            ->where('posts.status', 1)
            ->orderby('posts.id', 'desc')
            ->paginate(3);
        $categories = Category::all();

        return view('user.filter_by_category', compact('posts', 'categories', 'filter_posts'));
    }

    // COMMENT SECTION
    public function post_comment(Request $request, $id)
    {
        $data = [
            'post_id' => $id,
            'user_id' => auth()->user()->id,
            'comment' => $request->comment,

        ];
        PostComment::insert($data);

        $notifacation = [
            'message' => 'Comment Created Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notifacation);
    }

    //QUATION 

    public function quation_ans()
    {
        $quationobj = new Question();
        $postjoin = new Post();

        $questions = $quationobj
            ->join('categories', 'categories.id', '=', 'questions.category_id')
            ->join('users', 'users.id', '=', 'questions.user_id')
            ->select('questions.*', 'categories.name as category_name', 'users.name as user_name', 'users.image as user_image')
            ->orderby('questions.id', 'desc')
            ->paginate(2);

        $posts = $postjoin
            ->join('categories', 'categories.id', '=', 'posts.category_id')
            ->select('posts.*', 'categories.name as category_name')
            ->where('posts.status', 1)
            ->orderby('posts.id', 'desc')
            ->paginate(3);

        $categories = Category::all();
        return view('user.question', compact('categories', 'questions', 'posts'));
    }

    public function quation_store(Request $request)
    {

        $request->validate([
            'category_id' => 'required',
            'question' => 'required',
        ]);

        $data = [
            'user_id' => auth()->User()->id,
            'category_id' => $request->category_id,
            'question' => $request->question,
        ];
        Question::create($data);

        $notifacation = [
            'message' => 'Comment Created Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notifacation);
    }

    public function quation_distroy($id){
        Question::find($id)->delete();


        $notifacation = [
            'message' => 'Question Deleted Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notifacation);

    }

     
}
