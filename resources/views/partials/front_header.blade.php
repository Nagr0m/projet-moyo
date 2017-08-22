<header>
	<div class="top">
		<h1 class="title">Lycée Moyo</h1>
		<div class="social"></div>
	</div>

	<div class="cover">
		
	</div>
	@if (Auth::check())
	{{ $user->username }}
	@endif
	<nav class="bottom">
		<a href="{{ route('home') }}">Home</a>
		<a href="{{ route('actus') }}">Actualités</a>
		<a href="{{ route('lycee') }}">Le lycée</a>
		<input type="text">
	</nav>
</header>
