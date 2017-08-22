@extends('layouts.front')

@section('title', 'toto')


@section('content')
	<div>
		<img src="{{ $post->url_thumbnail }}" alt="">
		<h3>{{ $post->title }}</h3>
		<p>{{ $post->abstract }}</p>
		<p><small>{{ $post->user->username }} - {{ $post->created_at }}</small></p>
		<div>
			<h4>Commentaires</h4>
			@forelse($post->comments as $comment)
				<p>
					{{ $comment->content }}<br>
					<small>{{ $comment->name }} - {{ $comment->created_at }}</small>
					
				</p>

			@empty
				<p>Auncun commentaire</p>
			@endforelse
		</div>
	</div>

@endsection