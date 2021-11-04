@extends('layouts.app')

<?php $tagTitle = $tag->tag_name; ?> 
@section('title', "$tagTitle | Edit | LaraBlog")


@section('content')

	<div class="container">
	
		<div class="row justify-content-center">
			<div class="col-md-6">
				<h3>Edit Tag</h3>
				<div class="card">
					<div class="card-header">
						<h6 class="card-title">Editing - {{ $tag->tag_name }}</h6>
					</div>
					<div class="card-body">				
						<form action="{{ route('tags.update', $tag->id) }}" method="POST" role="form">
							@csrf
							{{ method_field('PATCH') }}
							<div class="form-group">
								<label for="">tag Name:</label>
								<input type="text" name="tag_name" class="form-control" value="{{ $tag->tag_name }}">
							</div>
						
							<button type="submit" class="btn btn-primary">Update Tag</button>
						</form>
						
					</div>
				</div>
			</div>
		</div>
	
	</div>

@endsection