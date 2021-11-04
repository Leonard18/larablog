@extends('layouts.app')

<?php $tagName = htmlspecialchars($tag->tag_name); ?>
@section('title', "$tagName | View | LaraBlog")

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-9">
				
				<div class="page-header">
				  <h1>{{ $tag->tag_name }} Tag</h1>
				  <p class="text-muted">{{ $tag->posts()->count() }} Posts</p>
				</div>
				
			</div>
			<div class="col-md-3">
				<a href="{{ route('tags.index') }}" class="btn btn-primary my-2 btn-block">View/Add New Tag</a>
				
				<form action="{{ route('tags.destroy', $tag->id) }}" method="post">
					@csrf
					{{ method_field('DELETE') }}
					<input type="submit" value="DELETE" class="btn btn-danger btn-block"> 
				</form>
			</div>
		</div>
		<hr>
	</div>

	<div class="container table-section my-5">
		<div class="table-responsive">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>#</th>
						<th>Title</th>
						<th>Tag</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach($tag->posts as $post)
						<tr>
							<td>{{ $post->id }}</td>
							<td><a href="{{ route('posts.show', $post->id) }}">{{$post->title}}</a></td>

							@foreach($post->tags as $tag)
								<td><span class="badge badge-secondary">{{ $tag->tag_name }}</span></td>
							@endforeach
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>


@endsection