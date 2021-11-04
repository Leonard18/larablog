<li class="nav-item {{ Route::is('/') ? 'active' : '' }}">
<a href="{{ route('pages.home') }}" class="nav-link">Home</a>
</li>

<li class="nav-item {{ Route::is('/blog') ? 'active' : '' }}">
<a href="{{ route('blog.index') }}" class="nav-link">Blog</a>
</li>

<li class="nav-item {{ Route::is('/posts') ? 'active' : '' }}"
>
<a href="{{ route('posts.index') }}" class="nav-link">Post</a>
</li>

<li class="nav-item {{ Route::is('/categories') ? 'active' : '' }}">
<a href="{{ route('categories.index') }}" class="nav-link">Category</a>
</li>

<li class="nav-item {{ Route::is('/tags') ? 'active' : '' }}">
<a href="{{ route('tags.index') }}" class="nav-link">Tag</a>
</li>

<li class="nav-item {{ Route::is('/comments') ? 'active' : '' }}">
<a href="{{ route('comments.index') }}" class="nav-link">Comment</a>
</li>