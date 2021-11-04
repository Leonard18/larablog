@extends('layouts.app')

@section('title', 'Create Post | laraBlog')

@section('scriptsandstyles')

	<script src="https://cdn.tiny.cloud/1/79nrpvydv7ipcck9ttcd20290e8kfkcteqw0ax5sgg7dd6h0/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

	<script>
		tinymce.init({
    			selector: '#textarea-editor',
          height: 500,
          // plugins: 'link code'
          plugins: [
            'advlist autolink link image lists charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
            'table emoticons template paste help imagetools'
          ],
          toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | ' +
            'bullist numlist outdent indent | link image | print preview media fullpage | ' +
            'forecolor backcolor emoticons | help | image',
          menu: {
            favs: {title: 'My Favorites', items: 'code visualaid | searchreplace | emoticons'}
          },
          menubar: 'favs file edit view insert format tools table help',
          content_css: 'css/content.css',

          // menubar: false,
          // toolbar: false,

 		 });
	</script>

@endsection

@section('content')

	
	<div class="container">
		<div class="page-header">
		  <h1>Create New Post</h1>
		  <p>Add a new post to the blog app.</p>
		</div>
		<hr>
	</div>

	<section class="contact mt-3">
		<div class="container">
			<div class="row">
				<div class="col-md-7">
					
					<form action="{{ route('posts.store') }}" method="POST" role="form" enctype="multipart/form-data" id="post-form">
						@csrf
						<div class="form-group">
							<label class="control-label">Title</label>
							<input type="text" name="title" class="form-control" id="" placeholder="Post Title" required>
						</div>

						<div class="form-group">
							<label class="control-label">Slug</label>
							<input type="text" name="slug" class="form-control" id="" placeholder="Post Slug" required>
						</div>

						<div class="form-group">
							<label class="control-label">Category</label>
							<select name="category_id" class="form-control" required="required">
								@foreach($categories as $category)
									<option value="{{ $category->id }}">{{ $category->category_name }}</option>
								@endforeach
							</select>
						</div>

						<div class="form-group">
							<label class="control-label">Tags</label>
							<select name="tags[]" class="form-control" id="tags" required="required" multiple>
								@foreach($tags as $tag)
									<option value="{{ $tag->id }}">{{ $tag->tag_name }}</option>
								@endforeach
							</select>
							
						</div>

		  				<div class="form-group">
							  <label class="control-label">Image</label>
							  <input type="file" name="image" class="form-control">
						  </div>

						<div class="form-group">
							<label class="control-label">Body</label>
							<textarea name="body" class="form-control" id="textarea-editor" rows="8"></textarea>
							
						</div>
					
				</div>
				<div class="col-md-1"></div>
				<div class="col-md-4">
					<div class="card">
						<div class="card-body text-center">
							<h4>Publish Section</h4>
		  					<div class="row mt-3">
								  <div class="col-md-5">
									  <button type="submit" class="btn btn-success">Publish</button>
									  </form>
								  </div>
								  <div class="col-md-1"></div>
								  <div class="col-md-5">
		  							<a href="{{ route('posts.index') }}" class="btn btn-danger btn-sm">Cancel</a>
								  </div>
							  </div>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	

@endsection

@section('specialsection')

	<script>
		$("#tags").select2();

		$("#post-form").parsley();

	</script>

@endsection