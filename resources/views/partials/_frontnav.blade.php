<li class="nav-item {{ Route::is('/') ? 'active' : '' }}">
	<a href="#" class="nav-link">Home</a>
</li>

<li class="nav-item {{ Route::is('/about') ? 'active' : ''}}">
	<a href="{{ route('pages.about') }}" class="nav-link">About</a>
</li>

<li class="nav-item {{ Route::is('/blog') ? 'active' : '' }}">
	<a href="{{ route('blog.index') }}" class="nav-link">Blog</a>
</li>

<li class="nav-item">
	<a href="{{ route('pages.contact') }} {{ Route::is('/contact') ? 'active' : '' }}" class="nav-link">Contact</a>
</li>
