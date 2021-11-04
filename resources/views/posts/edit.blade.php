@extends('layouts.app')

<?php $postTitle = $post->title; ?>

@section('title', "Edit | $postTitle | laraBlog")

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
		  <h1>Update Post</h1>
		  <p>A post with current facts has more engagements.</p>
		</div>
		<hr>
	</div>

	<section class="contact mt-3">
		<div class="container">
			<div class="row">
				<div class="col-md-7">
					
					<form action="{{ route('posts.update', $post->id) }}" method="POST" role="form" enctype="multipart/form-data" id="post-form">
						@csrf
						{{ method_field("PATCH") }}
						<div class="form-group">
							<label class="control-label">Title</label>
							<input type="text" name="title" class="form-control" id="" value="{{ $post->title }}" required>
						</div>

						<div class="form-group">
							<label class="control-label">Slug</label>
							<input type="text" name="slug" class="form-control" id="" value="{{ $post->slug }}" required>
						</div>

						<div class="form-group">
							<label class="control-label">Category</label>
							<select name="category_id" class="form-control" required="required">
								<option value="{{ $post->category->id }}" selected>{{ $post->category->category_name }}</option>
								@foreach($categories as $category)
									<option value="{{ $category->id }}">{{ $category->category_name }}</option>
								@endforeach
							</select>
						</div>

						<div class="form-group">
							<label class="control-label">Tags</label>
							<select name="tags[]" class="form-control" id="tags" required="required" multiple>
								@foreach($tags as $tag)
									<option value="{{ $tag->id }}" {{ in_array($tag->id, $post->tags->pluck('id')->toArray()) ? "selected" : "" }}>{{ $tag->tag_name }}</option>
								@endforeach
							</select>
							
						</div>

		  				<div class="form-group">
							  <label class="control-label">Image</label>
							  <input type="file" name="image" class="form-control">
						  </div>

						<div class="form-group">
							<label class="control-label">Body</label>
							<textarea name="body" class="form-control" id="textarea-editor" rows="8">{{ strip_tags($post->body) }}</textarea>
							
						</div>
					
				</div>
				<div class="col-md-1"></div>
				<div class="col-md-4">
					
					<div class="card">
					
					<div class="card-body">

						<div class="post-details text-center mb-3">
						<h5>Current Url:</h5>
						<a href="{{ route('blog.single', $post->slug) }}">{{ route('blog.single', $post->slug) }}</a>
						<h5>Created At:</h5>
						<p class="text-muted"><small>{{ $post->created_at }}</small></p>
						<h5>Last Updated:</h5>
						<p class="text-muted"><small>{{ $post->updated_at }}</small></p>
						<h5>Category:</h5>
						<p class="text-muted"><small>{{ $post->category->category_name }}</small></p>
					</div>
				
					<div class="row justify-content-center">

							<button type="submit" class="btn btn-success btn-sm col-md-6 mr-1">Update</button>

							</form>

							<a href="{{ route('posts.index') }}" class="btn btn-danger btn-sm col-md-5 ">Cancel</a>

					</div>

					<a href="{{ route('posts.index') }}" class="btn btn-default btn-block mt-4" style="border: 2px solid gray !important;"><< See All Posts</a>
					
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