@extends('layouts.front')

@section('title', 'toto')


@section('content')
	<div>
		<img src="{{ $post->url_thumbnail }}" alt="">
		<h3>{{ $post->title }}</h3>
		<p>{{ $post->abstract }}</p>
		<p><small>{{ $post->user->username }} - {{ $post->published_at->format('d/m/Y') }}</small></p>
		<div>
			<h4>Commentaires</h4>
			@forelse($post->comments as $comment)
				<p>
					{{ $comment->content }}<br>
					<small>{{ $comment->name }} - {{ $post->created_at->format('d/m/Y H:i') }}</small>
					
				</p>

			@empty
				<p>Auncun commentaire</p>
			@endforelse
		</div>
	</div>

@endsection