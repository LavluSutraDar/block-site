<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        //$post = Post::all()->where('status',1)->sortByDesc('created_at');
       
        $postjoin = new Post();

        $posts = $postjoin
        ->join('categories', 'categories.id', '=', 'posts.category_id')
        ->select('posts.*', 'categories.name as category_name')
        ->where('posts.status', 1)
        ->orderby('posts.id', 'desc')
        ->get();
        $categories = Category::all();
        return view('user.index', compact('posts', 'categories'));
    }

    public function single_post_view($id){

        $postjoin = new Post();

        $post = $postjoin
            ->join('categories', 'categories.id', '=', 'posts.category_id')
            ->select('posts.*', 'categories.name as category_name')
            ->where('posts.id', $id)
            ->first();

        return view('user.single_post_view', compact('post'));

    }

    public function filter_by_category($id){
        $postjoin = new Post();

        $postjoin = new Post();
        $posts = $postjoin->join('categories', 'categories.id', '=', 'posts.category_id')
        ->select('posts.*', 'categories.name as category_name')
        ->where('posts.status', 1)
        ->where('posts.category_id', $id)
        ->orderby('posts.id', 'desc')
        ->get();

        return view('user.filter_by_category', compact('posts'));
    }
}
