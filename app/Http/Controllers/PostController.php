<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Category;
use App\Tag;
use App\User;
use Session;
use Image;
use Purifier;
use Storage;

class PostController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate();

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate the form data... 
        $this->validate($request, array(
            'title' => 'required|min:2|max:255|string|unique:posts,title',
            'slug' => 'required|alpha_dash|min:3|max:255|unique:posts,slug',
            'body' => 'required|min:10|max:2500',
            'category_id' => 'required|integer',
            'image' => 'sometimes|image|mimes:jpg,jpeg,png,git,',
        ));

        //Retrieve the data from the form... 
        $post = new Post();
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->body = Purifier::clean($request->body);
        $post->author = auth()->user()->username;
        $post->category_id = $request->category_id;
        $post->user_id = auth()->user()->id;
        $post->created_at = now();
        $post->updated_at = now();

        //Get the image file.. 
        if ($request->hasFile('image')) {
            //Get the file... 
            $image = $request->file('image');
            $filename = uniqid('post_image', true) . "." . time() . "." . $image->getClientOriginalName() . "." . $image->getClientOriginalExtension();

            //Set location for the image... 
            $location = storage_path('app/public/postimages/' . $filename);

            //Resize and save the image 
            Image::make($image)->resize(800, 400)->save($location);

            $post->image = $filename;
        }

        //Save the post now... 
        $post->save();

        //Synchronize the tags to the post... 
        $post->tags()->sync($request->tags, false);

        //Send a flash message... 
        Session::flash('success', 'Post created successfully!');

        //Redirect to the post page... 
        return redirect()->route('posts.show', $post->id);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
            //Query the database for the post... 
            $post = Post::find($id);

         //Validate the form data... 
         $this->validate($request, array(
            'title' => 'required|min:2|max:255|string|unique:posts,title',
            'slug' => 'required|alpha_dash|min:3|max:255|unique:posts,slug',
            'body' => 'required|min:10|max:2500',
            'category_id' => 'required|integer',
            'image' => 'sometimes|image|mimes:jpg,jpeg,png,git,',
        ));

        //Retrieve the data from the form... 
        $post = Post::find($id);

        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->body = Purifier::clean($request->body);
        $post->author = auth()->user()->username;
        $post->category_id = $request->category_id;
        $post->user_id = auth()->user()->id;
        $post->updated_at = now();

        //Get the image file.. 
        if ($request->hasFile('image')) {
            //Get the file... 
            $image = $request->file('image');
            $filename = uniqid('post_image', true) . "." . time() . "." . $image->getClientOriginalName() . "." . $image->getClientOriginalExtension();

            //Set location for the image... 
            $location = storage_path('app/public/postimages/' . $filename);

            //Resize and save the image 
            Image::make($image)->resize(800, 400)->save($location);

            //Get the old image before updating the database...
            $oldImage = $post->image;

            //Update the database... 
            $post->image = $filename;

            //Delete the old image from the database and filesystem..
            Storage::delete('public/postimages/' . $oldImage);

        }

        //Save the post to the database before checking for tags... 
        $post->save();

        //Check if there are tags attached to the post... 
        if (isset($request->tags)) {
            $post->tags()->sync($request->tags);
        } else {
            $post->tags()->sync(array());
        }

        //Send a flash message... 
        Session::flash('success', 'Post updated successfully!');

        //Redirect to the post page... 
        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Grab the post from the database... 
        $post = Post::find($id);

        //Detach the post from the tags... 
        $post->tags()->detach();

        //Delete the comment as well...
        $post->comments()->delete();

        //Delete the post image as welll... 
        Storage::delete('public/postimages/' . $post->image);

        //Delete the main post... 
        $post->delete();

        //Send a flash message... 
        Session::flash('success', 'Post deleted successfully!');

        //Redirect to the main post page... 
        return redirect()->route('posts.index');
    }
}
