@extends('layouts.app')

@section('title', 'Blog | LaraBlog')

@section('content')

	<div class="container text-center">
		<div class="page-header">
		  <h1>Blog Page</h1>
		  <p><small>Read even exciting news about our blog.</small></p>
		  <hr>
		</div>
	</div>

	<div class="container">
		<div class="row justify-content-center">
			@forelse($posts as $post)
				<div class="col-md-4">
					<div class="card my-4">
						<div class="card-body">
							<h3 class="card-title">{{ $post->title }}</h3>
							{{ $post->author }} <br>
							{{ date('M j, Y', strtotime($post->created_at)) }}
							<hr>
							<p class="card-text">{{ substr(strip_tags($post->body), 0, 50) }} {{ strlen($post->body) > 50 ? "..." : "" }}</p>
							<hr>

							<a href="{{ route('blog.single', $post->slug) }}" class="btn btn-primary btn-sm float-right">Read more</a>
							<a href="#" class="text-muted">Quick view</a>
						</div>
					</div>
				</div>
			@empty
				<h4 class="text-muted">No records found.</h4>
			@endforelse
		</div>
	</div>

@endsection