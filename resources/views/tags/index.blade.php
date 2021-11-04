@extends('layouts.app')

@section('title', 'Tags | LaraBlog')

@section('content')

	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-7">
				<h2>Tags Page</h2>
				<p><small>All available tags on this blog app!</small></p>
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
							@forelse($tags as $tag)
								<tr>
									<td>{{ $tag->id }}</td>
									<td><a href="{{ route('tags.show', $tag->id) }}">{{ $tag->tag_name }}</a></td>
									<td>
										<a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-primary btn-sm">Edit</a>
										<form action="{{ route('tags.destroy', $tag->id) }}" method="post" class="form-inline">
											@csrf
											{{ method_field('DELETE') }}
											<input type="submit" class="btn btn-danger btn-sm" value="Delete">
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
						<form action="{{ route('tags.store') }}" method="POST" role="form">
							@csrf
							<div class="form-group">
								<label class="control-label" for="tag_name">Name</label>
								<input type="text" name="tag_name" class="form-control" id="tag_name" placeholder="Tag name here...">
							</div>
						
							<button type="submit" class="btn btn-primary">Add Tag</button>
						</form>
						
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection