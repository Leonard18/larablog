@extends('layouts.app')

<?php $catTitle = $category->category_name; ?> 
@section('title', "$catTitle | Edit | LaraBlog")


@section('content')

	<div class="container">
	
		<div class="row justify-content-center">
			<div class="col-md-6">
				<h3>Edit Category</h3>
				<div class="card">
					<div class="card-header">
						<h6 class="card-title">Editing - {{ $category->category_name }}</h6>
					</div>
					<div class="card-body">				
						<form action="{{ route('categories.update', $category->id) }}" method="POST" role="form">
							@csrf
							{{ method_field('PATCH') }}
							<div class="form-group">
								<label for="">Category Name:</label>
								<input type="text" name="category_name" class="form-control" value="{{ $category->category_name }}">
							</div>
						
							<button type="submit" class="btn btn-primary">Update Category</button>
						</form>
						
					</div>
				</div>
			</div>
		</div>
	
	</div>

@endsection