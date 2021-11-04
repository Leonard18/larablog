<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Session;
use App\Post;


class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();

        return view('tags.index', compact('tags'));
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
        //Validate the tag... 
        $this->validate($request, array(
            'tag_name' => 'required|min:2|max:40'
        ));

        $tag = new Tag();
        $tag->tag_name = $request->tag_name;
        $tag->created_at = now();
        $tag->updated_at = now();

        //Save the new tag... 
        $tag->save();

        //Send a flash message... 
        Session::flash('success', 'Tag created successfully!');

        //Redirect... 
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    // public function show($id)
    {
        // $tag = Tag::findOrFail($tag);
        return view('tags.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        return view('tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Create a new instance of Tag... 
        $tag = Tag::find($id);

        //Validate the tag... 
        $this->validate($request, array(
            'tag_name' => 'required|min:2|max:255|unique:tags,tag_name'
        ));

        //Create another instance of the Tag class... 
        $tag = Tag::find($id);

        //Update the table... 
        $tag->tag_name = $request->tag_name;
        $tag->updated_at = now();

        //Save the data now... 
        $tag->save();

        //Send a flash message... 
        Session::flash('success', 'Tag updated successfully!');

        //Redirect to the index page... 
        return redirect()->route('tags.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Query the database for the tag... 
        $tag = Tag::find($id);

        //Detach the tag from the post... 
        $tag->posts()->detach();

        //Delete the tag... 
        $tag->delete();

        //Send a flash message to the user... 
        Session::flash('success', 'Tag deleted successfully');

        //Redirect the user to the tag index page... 
        return redirect()->route('tags.index');
    }
}
