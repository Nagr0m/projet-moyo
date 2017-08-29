@extends('layouts.front')

@section('title', 'Actualités')


@section('content')
	<div class="container" id="postsIndex">
		<h2>Tous les articles</h2>
		@forelse ($posts as $post)
			<div class="only-sm">
				<div class="gradient-mask featured-img" style="background-image: url({{ $post->urlThumbnail }})">
					<a href="{{ route('actu', $post->id) }}" title="{{ $post->title}}">
						<h2>{{ $post->title }}</h2>
					</a>
				</div>
				<div class="item-content">
					<p class="hide-xs">{{ $post->abstract }}</p>
					<small>Par <b>{{ $post->user->username }}</b> le <b>{{ $post->created_at }}</b> | {{ $post->comments_count }} commentaire{{ plural_string($post->comments_count) }}</small>
				</div>
			</div>
			<div class="valign item only-xl">
				<a href="{{ route('actu', $post->id) }}" title="{{ $post->title }}">
					<img class="item-caption" src="{{ $post->smallThumbnail }}">
				</a>
				<div class="item-content">
					<a class="inverse" href="{{ route('actu', $post->id) }}">
						<h2>{{ $post->title }}</h2>
					</a>
					<p class="hide-xs">{{ $post->abstract }}</p>
					<small>Par <b>{{ $post->user->username }}</b> le <b>{{ $post->created_at }}</b> | {{ $post->comments_count }} commentaire{{ plural_string($post->comments_count) }}</small>
				</div>
			</div>
			@if (!$loop->last)
				<div class="divider"></div>
			@endif

		@empty
			<p>Aucune actualités</p>
		@endforelse
		<div>
			{{ $posts->links() }}
		</div>
	</div>
@endsection