@extends('layouts.app')

@section('title', 'All Posts | LaraBlog')


@section('content')

	<div class="container mt-2">
		<div class="row">
			<div class="col-md-8">
				
				<div class="page-header">
				  <h1>All Posts</h1>
				  <p><small>All posts on this great blog</small></p>
				</div>
				
			</div>
			<div class="col-md-1"></div>
			<div class="col-md-3">
				<a href="{{ route('posts.create') }}" class="btn btn-success btn-block mt-3">Add New Post</a>
			</div>
		</div>
	</div>
	<hr>

	<div class="container">
		<div class="table-responsive">
		
		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th>#</th>
					<th>Title</th>
					<th>Body</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@forelse($posts as $post)
					<tr>
						<td>{{ $post->id }}</td>
						<td>{{ $post->title }}</td>
						<td>{{ substr(strip_tags($post->body), 0, 50) }} {{ strlen($post->body) > 50 ? "..." : "" }}</td>
						<td>
							<a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary btn-sm">View</a>
							<a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning btn-sm">Edit</a>

							<form action="{{ route('posts.destroy', $post->id) }}" method="POST" role="form">
								@csrf
								{{ method_field('DELETE') }}
								<button type="submit" class="btn btn-danger btn-sm">Delete</button>
							</form>
						</td>
					</tr>
				@empty
					<tr><td colspan="4" class="text-muted text-center">No records found.</td></tr>
				@endforelse
			</tbody>
		</table>
		
		</div>
	</div>

	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-3">
				{{ $posts->links() }}
			</div>
		</div>
	</div>


@endsection