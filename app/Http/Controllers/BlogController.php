<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use App\Category;
use App\User;
use App\Tag;

class BlogController extends Controller
{
    public function getIndex() {

        $posts = Post::orderBy('id', 'desc')->paginate(9);

        return view('blog.index', compact('posts'));

    }

    public function getSingle($slug) {

        //Fetch the data based on the given slug... 
        $post = Post::where('slug', $slug)->first();

        return view('blog.single', compact('post'));

    } 
}
