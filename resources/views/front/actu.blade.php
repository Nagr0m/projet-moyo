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
		<div class="divider" id="commentaires"></div>
		<div class="comments-wrapper">
			<h3>Laisser un commentaire</h3>
			@if (Session::get('message'))
				<p class="sessionMessage">{{ Session::get('message') }}</p>
			@endif
			<form method="post" action="{{ route('comment') }}" class="newCommentForm validate" novalidate>
				{{ csrf_field() }}
				<input type="hidden" name="post_id" value="{{ $post->id }}">
				<div class="field">
					<label for="name">
						Votre nom
					</label>
					<input type="text" name="name" id="name" value="{{ old('name') }}" required>
				</div>
				<div class="field">
					<label for="content">
						Votre commentaire
					</label>
					<textarea rows="7" cols="40" name="content" id="content" required>{{ old('content') }}</textarea>
				</div>
				<div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_PUBLIC') }}"></div>
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
@endsection

@section ('scripts')
    @parent
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="{{ URL::asset('utils/js/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('js/frontValidate.js') }}"></script>
@endsection