@extends('layouts.front')

@section('title', 'Actualités')


@section('content')
	{{-- {{ dd($posts) }} --}}
	@forelse ($posts as $post)
		<div>
		{{-- {{ dd($post) }} --}}
			<h3>{{ $post->title }}</h3>
			<p>{{ $post->abstract }}</p>
			<p><small>{{ $post->user->username }} - {{ $post->created_at }}</small></p>
			<p><small>{{ $post->comments_count }} commentaires</small></p>
		</div>

	@empty
		<p>Aucune actualités</p>
	@endforelse
	<div>
		{{ $posts->links() }}
	</div>
@endsection