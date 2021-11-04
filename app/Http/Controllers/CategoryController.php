<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Session;
use App\Post;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate the incomming text string... 
        $this->validate($request, array(
            'category_name' => 'required|min:2|max:40',
        ));

        //Store the new category... 
        $category = new Category();
        $category->category_name = $request->category_name;
        $category->created_at = now();
        $category->updated_at = now();

        //Save the category... 
        $category->save();

        //Send a flash message... 
        Session::flash('success', 'Category successfully created!');

        //Redirect back to the index page... 
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // //Query the database for the id... 
        $category = Category::find($id);

        //Validate the incoming request... 
        $this->validate($request, array(
            'category_name' => 'required|min:2|max:255|unique:categories,category_name'
        ));

        //Create another instance of the Cat class... 
        $category = Category::find($id);

        $category->category_name = $request->category_name;
        $category->updated_at = now();

        //Save the new content to the database... 
        $category->save();

        //Send a flash message to the user... 
        Session::flash('success', 'Category updated successfully!');

        //Redirect the use to the index page... 
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Query the categories table for the $categories id... 
        $category = Category::find($id);

        //Query the post table as well... 
        $post = Post::find($id);
        
        //Set the post category_id field to null... 
        $postupdate = new Post();
        $postupdate->title = $post->title;
        $postupdate->slug = $post->slug;
        $postupdate->body = $post->body;
        $postupdate->author = $post->author;
        $postupdate->category_id = NULL;
        $postupdate->user_id = $post->user_id;
        $postupdate->image = $post->image;
        $postupdate->created_at = $post->created_at;
        $postupdate->updated_at = $post->updated_at;
        $postupdate->save();
        
        //Safely delete the category... 
        $category->delete();

        //Send a flash message... 
        Session::flash('success', 'Delete successful!');

        //Return to the index page... 
        return redirect()->back();


    }
}
