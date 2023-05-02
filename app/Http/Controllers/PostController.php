<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

use function Pest\Laravel\post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Category::all();
        $objpost = new Post();

        $post = $objpost->join('categories', 'categories.id', '=', 'posts.category_id')
        ->select('posts.*', 'categories.name as category_name')->get();
        

        //$data = DB::table('categories')->get();
        return view('admin.post.post', compact('data', 'post'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'posttitle' => 'required',
            'postdescription' => 'required',
            'thumbnail'=> 'required',
        ]);

        $data = array(
            'category_id' => $request->category_id,
            'title' => $request->posttitle,
            'description' => $request->postdescription,
            'status' => $request->status,
        );

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $extension = $file->getClientOriginalExtension();
            $thumbnail_name = time()  . '.' . $extension;
            $file->move(public_path('backend/post_thumbnail/'), $thumbnail_name);
            $data['thumbnail'] = $thumbnail_name;
        }
        Post::create($data);

        $notifacation = [
            'message' => 'Post Created Successfully',
            'alert-type' => 'info',
        ];
        return redirect()->back()->with($notifacation);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $validated = $request->validate([
            'category_id' => 'required',
            'edit_post_title' => 'required',
            'edit_post_description' => 'required',
            'thumbnail' => 'required',
            
        ]);

        $data = array(
            'category_id' => $request->category_id,
            'title' => $request->edit_post_title,
            'description' => $request->edit_post_description,
            'status' => $request->status,
            //'thumbnail' => $request->thumbnail,
        );

        if ($request->hasFile('thumbnail')) {

            if ($request->old_thumbnail) {
                File::delete(public_path('backend/post_thumbnail/' . $request->old_thumbnail));
                
            }

            $file = $request->file('thumbnail');
            $extension = $file->getClientOriginalExtension();
            $thumbnail_name = time()  . '.' . $extension;
            $file->move(public_path('backend/post_thumbnail/'), $thumbnail_name);
            $data['thumbnail'] = $thumbnail_name;
        }

        $notifacation = [
            'message' => 'Post Update Successfully',
            'alert-type' => 'info',
        ];
      
            Post::where('id', $id)->update($data);
            return redirect()->back()->with($notifacation);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $product = Post::find($id);
         if($product->thumbnail){
            File::delete(public_path('backend/post_thumbnail/' . $product->thumbnail));
         }
        $product->delete();
        return Redirect()->back();
    }
}
