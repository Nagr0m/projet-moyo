@extends('layouts.front')

@section('title', 'Accueil')


@section('content')
	@forelse ($posts as $post)
		<div>
			<h2><a>{{ $post->title }}</a></h2>
			<p><small>{{ $post->user->username }} - {{ $post->created_at }}<br>
			{{ $post->comments_count }} commentaire{{ plural_string($post->comments_count) }}</small></p>
		</div>
		
	@empty
		<p>Aucune actualités</p>
	@endforelse
@endsection
