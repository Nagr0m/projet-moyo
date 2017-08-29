<header>

	<div class="cover valign">
		<a href="{{ route('home') }}" class="valign inverse">
			<img class="logo" src="{{ URL::asset('img/school_logo.png') }}">
			<h1 class="title">Lycée Moyo</h1>
		</a>
		<nav class="bottom valign">
			<a {{ classActivePath('/') }} href="{{ route('home') }}">Accueil</a>
			<a {{ classActivePath('actu') }} href="{{ route('actus') }}">Actualités</a>
			<a {{ classActivePath('lycee') }} href="{{ route('lycee') }}">Le lycée</a>
			<a href="{{ route('loginPage') }}">
				@if (Auth::check())
					<span class="typcn typcn-user-outline"></span> {{ $user->username }}
				@else
					<span class="typcn typcn-user-outline"></span> Se connecter
				@endif
 			</a>
		</nav>
	</div>
	
</header>
