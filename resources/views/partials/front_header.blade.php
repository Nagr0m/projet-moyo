<header>
	{{--  <div class="top">
		<div class="social">
			<div class="fb-like" data-href="https://www.facebook.com/lecolemultimedia/" data-layout="button" data-action="like" data-size="large" data-show-faces="false" data-share="false"></div>
			<a href="https://twitter.com/ecolemultimedia" class="twitter-follow-button" data-show-count="false" data-size="large">Follow @ecolemultimedia</a>
		</div>
	</div>  --}}

	<div class="cover valign">
		<a href="{{ route('home') }}" class="valign inverse">
			<img class="logo" src="{{ URL::asset('img/school_logo.png') }}">
			<h1 class="title">Lycée Moyo</h1>
		</a>
		<nav class="bottom valign">
			<a {{ classActivePath('/') }} href="{{ route('home') }}">Accueil</a>
			<a {{ classActivePath('actu') }} href="{{ route('actus') }}">Actualités</a>
			<a {{ classActivePath('lycee') }} href="{{ route('lycee') }}">Le lycée</a>
			<a href="{{ route('login') }}">
				@if (Auth::check())
					<span class="typcn typcn-user-outline"></span> {{ $user->username }}
				@else
					<span class="typcn typcn-user-outline"></span> Se connecter
				@endif
 			</a>
		</nav>
	</div>
	
</header>
