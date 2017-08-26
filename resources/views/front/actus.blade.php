@extends('layouts.front')

@section('title', 'Actualités')


@section('content')
	<div class="container" id="postsIndex">
		@forelse ($posts as $post)
			<div class="valign item" href="{{ route('actu', $post->id) }}">
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