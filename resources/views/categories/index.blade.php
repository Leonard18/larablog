@extends('layouts.app')

@section('title', 'Categories | LaraBlog')

@section('content')

	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-7">
				<h2>Categories Page</h2>
				<p><small>All available categories on this blog app!</small></p>
				<hr>
				<div class="table-responsive">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@forelse($categories as $category)
								<tr>
									<td>{{ $category->id }}</td>
									<td>{{ $category->category_name }}</td>
									<td>
										<a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary btn-sm">Edit</a>
										<form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="form">
											@csrf
											{{ method_field('DELETE') }}
											<button type="submit" class="btn btn-danger btn-sm">DELETE</button>
										</form>
									</td>
								</tr>
							@empty
								<tr><td colspan="3">No records founds.</td></tr>
							@endforelse
						</tbody>
					</table>
				</div>
			</div>
			<div class="col-md-1"></div>
			<div class="col-md-4">
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Add New Categort</h4>
					</div>
					<div class="card-body">
						<form action="{{ route('categories.store') }}" method="POST" role="form">
							@csrf
							<div class="form-group">
								<label class="control-label" for="category_name">Name</label>
								<input type="text" name="category_name" class="form-control" id="category_name" placeholder="Category name here...">
							</div>
						
							<button type="submit" class="btn btn-primary">Add Category</button>
						</form>
						
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection