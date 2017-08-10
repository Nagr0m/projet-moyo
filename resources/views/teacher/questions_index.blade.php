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
                <form action="{{ route('questions.destroy', $question->id) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <a class="destroy" data-resource="ce questionnaire">delete</a>
                </form>
            </p>
        @empty
            Aucun questionnaire
        @endforelse
    </div>

@endsection