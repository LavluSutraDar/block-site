<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $category = Category::all();
        return view('admin.category.index', compact('category'));
        //dd($category);
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
            'name' => 'required|unique:categories,name|max:255',
            'description' => 'required',
        ]);

        $data = array(
            'name' => $request->name,
            'description' => $request->description,
        );


        Category::insert($data);
        //DB::table('categories')->insert($data);

        $notifacation = [
            'message' => 'Category Created Successfully',
            'alert-type' => 'success',
        ];

        return back()->with($notifacation);

        //MODEL R MADDOME INSERT
        // subcategory::insert([
        //     'category_id' => $request->category_id,

        //     'subcategory_name' => $request->subcategoryname,

        // ]);

       
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
        //$data = Category::find($id);
        //return view('admin.category.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cat_update = Category::find($id);

        $validated = $request->validate([
            'editname' => 'required|unique:categories,name,' . $cat_update->id . '|max:255',
            'editdescription' => 'required',
        ]);



        $cat_update->update([
            'name' => $request->editname,
            'description' => $request->editdescription,
        ]);

        $notifacation = [
            'message' => 'Category Update Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('category.index')->with($notifacation);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        DB::table('categories')->where('id', $id)->delete();
        return Redirect()->back();
    }
}
