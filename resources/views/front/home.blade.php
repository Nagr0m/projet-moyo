@extends('layouts.front')

@section('title', 'Accueil')


@section('content')
	<p>This is the content.</p>
	@forelse ($posts as $post)
		<div>
			<h3>{{ $post->title }}</h3>
			<p>{{ $post->abstract }}</p>
			<p><small>{{ $post->user->username }} - {{ $post->published_at }}</small></p>
			<p><small>{{ $post->commentsCount }} commentaires</small></p>
		</div>
		
	@empty
		<p>Aucune actualités</p>
	@endforelse
@endsection

@section('sidebar')
	<p>This is the sidebar.</p>
	<a class="twitter-timeline" href="https://twitter.com/ecolemultimedia" data-height="600">Tweets by ecolemultimedia</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
@endsection