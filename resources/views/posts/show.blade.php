@extends('layouts.app')

<?php $postTitle = $post->title; ?>

@section('title', "$postTitle | LaraBlog")


@section('content')

	<div class="container">
	
		<div class="row">
		
			<div class="col-md-7">

				<img src="{{ asset('/storage/postimages/' . $post->image) }}" alt="" style="width: 100% !important; height: 250px;" class="mb-4">

				<h1>{{ $post->title }}</h1>
					<p class="text-muted">Posted By - <span class="text-bold">{{ $post->author }}</span></p>
					<p class="text-muted">Posted on - <span class="text-bold">{{ date('M j, Y', strtotime($post->created_at)) }}</span></p>
					<hr>
					<p>{{ strip_tags($post->body) }}</p>
					<br>
					@foreach($post->tags as $tag)
						<span class="badge badge-primary">{{ $tag->tag_name }}</span>
					@endforeach
					
					<hr>

					<h3>Comments</h3>
					
					@if(count($post->comments) > 0)
						<div class="table-responsive">
							<table class="table tablr-striped">
								<thead>
									<tr>
										<th>#</th>
										<th>Name</th>
										<th>Comment</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									@foreach($post->comments as $comment)
									<tr>
										<td>{{ $comment->id }}</td>
										<td>{{ $comment->name }}</td>
										<td>{{ $comment->comment }}</td>
										<td>
											<a href="{{ route('comments.edit', $post->id) }}" class="btn btn-primary btn-sm">Edit</a>
											<a href="{{ route('comments.destroy', $post->id) }}" class="btn btn-danger btn-sm">Delete</a>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
							@else 
								<p class="text-muted">No comments yet!</p>
							@endif


			</div>

			<div class="col-md-1"></div>


			<div class="col-md-4">
				<div class="card">
					
					<div class="card-body">

						<div class="post-details text-center mb-3">
						<h5>Url:</h5>
						<a href="{{ route('blog.single', $post->slug) }}">{{ route('blog.single', $post->slug) }}</a>
						<h5>Created At:</h5>
						<p class="text-muted"><small>{{ $post->created_at }}</small></p>
						<h5>Last Updated:</h5>
						<p class="text-muted"><small>{{ $post->updated_at }}</small></p>
						<h5>Category:</h5>
						<p class="text-muted"><small>{{ $post->category->category_name }}</small></p>
					</div>
				
					<div class="row justify-content-center">

							<a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary btn-sm col-md-6 mr-1">Edit</a>

							<form class="form" role="form" action="{{ route('posts.destroy', $post->id) }}" method="POST" role="form">
								@csrf
								{{ method_field('DELETE') }}
								<button type="submit" class="btn btn-danger btn-sm">Delete</button>
							</form>

					</div>

					<a href="{{ route('posts.index') }}" class="btn btn-default btn-block mt-4" style="border: 2px solid gray !important;"><< See All Posts</a>
					
					</div>
			
				</div>
			
			</div>

		</div>
	
	</div>
	

@endsection