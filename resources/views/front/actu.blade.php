@extends('layouts.front')

@section('title', $post->title)


@section('content')
	<div class="container">
		<div class="gradient-mask featured-img" style="background-image: url({{ $post->urlThumbnail }})">
			<a href="{{ $post->urlThumbnail }}" target="_blank" title="Ouvrir l'image">
				<h2>
					{{ $post->title }}
				</h2>
			</a>
		</div>
		<p class="lead">
			{{ $post->abstract }}
		</p>
		<p>
			{!! nl2br($post->content) !!}
		</p>
		<p class="meta">
			Par {{ $post->user->username }} -
			Publié le {{ $post->created_at }} <br>
			@if ($post->updated_at)
				Mis à jour le {{ $post->updated_at }}
			@endif
		</p>
		<div class="divider"></div>
		<div class="comments-wrapper">
			<h3>Laisser un commentaire</h3>
			<form method="post" action="{{ route('comment') }}" class="newCommentForm">
				{{ csrf_field() }}
				<input type="hidden" name="post_id" value="{{ $post->id }}">
				<label for="name">
					Votre nom
				</label>
				<input type="text" name="name" id="name" value="{{ old('name') }}">
				<label for="content">
					Votre commentaire
				</label>
				<textarea rows="7" cols="40" name="content" id="content">{{ old('content') }}</textarea>
				<br>
				<div class="g-recaptcha" data-sitekey="6LdFVC4UAAAAAJBkFV8uvNXcDnr-DKczs1My1cVo"></div>
				<button class="submit">Envoyer</button>
			</form>
			<div class="divider"></div>
			<h3>{{ $post->comments->count() }} commentaire{{ plural_string($post->comments->count()) }}</h3>

			@forelse($post->comments as $comment)
				<div class="valign">
					<img src="{{ $comment->authorIcon }}">
					<p>
						<small> <b>{{ $comment->name }}</b> - {{ $comment->created_at }} </small> <br>
						{{ $comment->content }}
					</p>
				</div>

			@empty
				<p>Auncun commentaire</p>
			@endforelse
		</div>
	</div>


<script src='https://www.google.com/recaptcha/api.js'></script>

@endsection