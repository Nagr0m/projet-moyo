@extends('layouts.back')

@section('title', 'Tous les questionnaires')

@section('content')

    <div class="section">
        <a class="btn green waves-effect waves-light z-depth-0" href="{{ route('questions.create') }}">Ajouter</a>
        @forelse($questions as $question)
            <p>
                <a href="{{ route('questions.edit', $question->id) }}">
                    {{ $question->content }}
                </a> @if($question->published) published @else unpublished @endif
            </p>
        @empty
            Aucun questionnaire
        @endforelse
    </div>

@endsection