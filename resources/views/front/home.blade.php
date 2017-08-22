@extends('layouts.front')

@section('title', 'Accueil')


@section('content')
	@forelse ($posts as $post)
		<div>
			<h3>{{ $post->title }}</h3>
			<p>{{ $post->abstract }}</p>
			<p><small>{{ $post->user->username }} - {{ $post->created_at }}</small></p>
			<p><small>{{ $post->comments_count }} commentaires</small></p>
		</div>
		
	@empty
		<p>Aucune actualités</p>
	@endforelse
@endsection
