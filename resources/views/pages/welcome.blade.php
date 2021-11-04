@extends('layouts.app')

@section('title', 'Home | LaraBlog')

@section('content')

    <div class="container">
        
        <div class="jumbotron">
            <div class="container">
                <h1>LaraBlog</h1>
                <p>Welcome to LaraBlog. A place for great writers and readers! We are dedicated to making sure that you have the latest technological information right at your finger tips.</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium omnis accusantium tempora voluptate numquam officia eveniet nulla illo optio eligendi.</p>
                <p>
                    <a class="btn btn-primary text-white mt-4">Trending Post</a>
                </p>
            </div>
        </div>
        
    </div>

    <section class="recent-post-section mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <h2>Recent Posts</h2>
                    <hr>
                    <div class="first-post-section">
                        @forelse($posts as $post)
                            <div class="card my-4">
                                <div class="card-body">
                                    <h4 class="card-title">{{ $post->title }}</h4>
                                    <p class="text-muted"><small>Posted By - {{ $post->author }}</small> <br> <small>Posted On - {{ date('M j, Y', strtotime($post->created_at)) }}</small></p>
                                    <hr>
                                    <p>{{ substr(strip_tags($post->body), 0, 100) }} {{ strlen($post->body) > 100 ? "..." : "" }}</p>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <a href="{{ route('blog.single', $post->slug) }}" class="btn btn-primary btn-sm">Read more</a>
                                        </div>
                                        <div class="col-md-6 float-right">
                                            <a href="#" class="text-muted">Quick view</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-muted">
                                <p>No Records Found.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-4">
                    <h3>Sidebar</h3>
                </div>
            </div>
        </div>
    </section>

    <section class="featured-posts-section mt-5">
        <div class="container">
            <h3>Featured Posts</h3>
            <hr>
            <div class="post-item-section">
                    <div class="row">
                @forelse($fposts as $fpost)
                    <div class="col-md-4">  
                    <div class="card my-3">
                        <div class="card-body">
                            <h4 class="card-title">{{ $fpost->title }}</h4>
                            <p class="text-muted"><small>Posted By - {{ $fpost->author }}</small> <br> <small>Posted On - {{ date('M j, Y', strtotime($fpost->created_at)) }}</small></p>
                            <hr>
                            <p>{{ substr(strip_tags($fpost->body), 0, 50) }} {{ strlen($fpost->body) > 50 ? "..." : "" }}</p>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="{{ route('blog.single', $fpost->slug) }}" class="btn btn-primary btn-sm">Read more</a>
                                </div>
                                <div class="col-md-6 float-right">
                                    <a href="#" class="text-muted">Quick view</a>
                                </div>
                            </div>
                        </div>
                    </div>
                   </div>
                @empty
                    <div class="text-muted">
                        <p>No Records Found!</p>
                    </div>
                @endforelse
                </div>
            </div>
        </div>
    </section>

    <section class="contact-section bg-primary mt-5 py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <h2 class="mb-5 text-center">We love to hear from you!</h2>
                    <div class="text-white">
                        @include('includes.contactform')
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="map-location">
        <div class="container-fluid">
            <h1>Map Location Section</h1>
        </div>
    </section>

@endsection