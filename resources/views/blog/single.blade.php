@extends('layouts.app')

<?php $postTitle = htmlspecialchars($post->title); ?>
@section('title', "$postTitle | LaraBlog")

@section('content')

	<div class="container">

		<a href="{{ route('blog.index') }}" class="btn btn-primary btn-sm"><< Back</a>
	
		<div class="row justify-content-center">
		
			<div class="col-md-8">
			
				<div class="image-section my-4">
					<img src="{{ asset('/storage/postimages/' . $post->image) }}" alt="" style="width: 100% !important; height: 300px !important;">
				</div>

				<div class="post-details-section">
				
					<h3>{{ $post->title }}</h3>
					<p class="text-muted"><small>Posted By - {{ $post->author }}</small> <br> <small>	Posted On - {{ date('M j, Y', strtotime($post->created_at)) }}</small></p>

					<hr>

					<p>{{ strip_tags($post->body) }}</p>

					<p class="mt-5">Posted in - <span class="badge badge-success">{{ $post->category->category_name }}</span></p>

					<p> Tags - 
						@foreach($post->tags as $tag)
							<span class="badge badge-dark">{{ $tag->tag_name }}</span>
						@endforeach
					</p>

				
				</div>

				<hr>

				<div class="comment-details-section my-3">
				
					<h3 class="mt-4">{{ count($post->comments) }} Comments.</h3>

					<div class="users-comments-section my-5">
					
						@foreach($post->comments as $comment)
							<p>{{ $comment->name }} {{ date('M j, Y', strtotime($comment->created_at)) }}</p>
							<p>{{ $comment->comment }}</p>
						@endforeach

						
					
					</div>

					<h5>Leave a comment.</h5>
					<p class="text-muted mb-3">Your email won't be visible to other users.</p>

					<form action="{{ route('comments.store') }}" method="POST" role="form">
						@csrf
						<div class="form-group">
							<input type="text" name="name" class="form-control" placeholder="Your name">
						</div>

						<div class="form-group">
							<input type="text" name="email" class="form-control" placeholder="Your email">
						</div>

						<input type="hidden" name="post_id" value="{{ $post->id }}">

						<div class="form-group">
							<textarea name="comment" class="form-control" rows="3" required="required"></textarea>
						</div>
					
						<button type="submit" class="btn btn-primary btn-block">Add Comment</button>
					</form>
					
				
				
				</div>
			
			</div>
		
		</div>
	
	</div>

@endsection