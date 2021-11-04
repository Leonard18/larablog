<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PageController extends Controller
{
    public function getIndex() {

        $posts = Post::orderBy('id')->limit(4)->get();

        $fposts = Post::orderBy('id', 'desc')->limit(6)->get();

        return view('pages.welcome', compact('fposts', 'posts'));

    }

    public function getAbout() {

        return view('pages.about');

    }

    public function getContact() {

        return view('pages.contact');

    }

    public function getSearch() {

        return view('pages.search');

    }

}
