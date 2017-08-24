@extends('layouts.front')

@section('title', 'Accueil')


@section('content')
		@foreach ($posts as $post)
			@if ($loop->first)	
				<div class="grid-3">
					<div class="two-thirds front-card">
						<a href="{{ route('actu', $post->id) }}" style="background-image: url({{ $post->urlThumbnail }});">
							<h2>
								{{ $post->title }}<br>
								<small>{{ $post->user->username }} - {{ $post->created_at }}</small>
							</h2>
						</a>
					</div>
			@elseif ($loop->iteration === 2)
					<div class="front-card">
						<a href="{{ route('actu', $post->id) }}" style="background-image: url({{ $post->urlThumbnail }});">
							<h2>
								{{ $post->title }}<br>
								<small>{{ $post->user->username }} - {{ $post->created_at }}</small>
							</h2>
						</a>
					</div>
				</div>
			@elseif ($loop->iteration === 3)
				<div class="grid-2">
					<div class="front-card">
						<a href="{{ route('actu', $post->id) }}" style="background-image: url({{ $post->urlThumbnail }});">
							<h2>
								{{ $post->title }}<br>
								<small>{{ $post->user->username }} - {{ $post->created_at }}</small>
							</h2>
						</a>
					</div>
			@else
					<div class="front-card">
						<a href="{{ route('actu', $post->id) }}" style="background-image: url({{ $post->urlThumbnail }});">
							<h2>
								{{ $post->title }}<br>
								<small>{{ $post->user->username }} - {{ $post->created_at }}</small>
							</h2>
						</a>
					</div>
				</div>
			@endif
		@endforeach
@endsection
