<div class="container mt-5">
	@if(Session::has('success'))
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>Success! </strong> {{ Session::get('success') }}
		</div>       
	@endif

	@if(count($errors) > 0)
		<div class="alert alert-danger">
			<strong>Error: </strong> 
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			@foreach($errors->all() as $error)
				<ul>
					<li>{{ $error }}</li>
				</ul>
			@endforeach
		</div>
				
	@endif
</div>