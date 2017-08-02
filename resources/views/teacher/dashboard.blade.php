@extends('layouts.back')

@section('title', 'Administration')

@section('content')
    <div class="section">
        <div class="row">

            <section class="col s12 l6">
                <article class="panel">
                    <div class="panel-head deep-orange-text text-darken-3">
                        <i class="material-icons left">school</i>Questionnaires
                    </div>
                    <div class="divider"></div>
                    <div class="panel-content">
                        @if(count($questions) > 0)
                            <div class="panel-title">Derniers questionnaires</div>
                        @endif
                        @forelse($questions as $question)
                            <span class="panel-item valign-wrapper">
                                <a href="{{ route('questions.edit', $question->id) }}">
                                     <i class="tiny material-icons left @if($question->published) light-green-text text-accent-4 @else red-text @endif">brightness_1</i>
                                     {{ $question->content }}
                                </a>
                            </span>
                            @if($loop->iteration === 5)
                                @break
                            @endif
                        @empty
                            Aucun questionnaire
                        @endforelse
                    </div>
                </article>

                <article class="panel">
                    <div class="panel-head light-blue-text">
                        <i class="material-icons left">description</i>Articles
                    </div>
                    <div class="divider"></div>
                    <div class="panel-content">
                        @if(count($posts) > 0)
                            <div class="panel-title">Derniers articles</div>
                        @endif
                        @forelse($posts as $post)
                            <span class="panel-item valign-wrapper">
                                <a href="{{ route('posts.edit', $post->id) }}">
                                    <i class="tiny material-icons left @if($post->published) light-green-text text-accent-4 @else red-text @endif">brightness_1</i>
                                    {{$post->title}}
                                </a>
                            </span>
                            @if($loop->iteration === 5)
                                @break
                            @endif
                        @empty
                            Aucun article
                        @endforelse
                    </div>
                </article>

            </section>

            <section class="col s12 l6">
                <article class="panel">
                    <div class="panel-head blue-grey-text">
                        <i class="material-icons left">poll</i>Statistiques
                    </div>
                    <div class="divider"></div>
                    <div class="panel-content">
                        <span class="panel-item valign-wrapper">
                            <a href="{{ route('questions.index') }}">
                                <i class="material-icons left light-blue-text">description</i>{{ $posts->count() }} article{{ plural_string($posts) }}
                            </a>
                        </span>
                        <span class="panel-item valign-wrapper">
                            <a href="{{ route('posts.index') }}">
                                <i class="material-icons left deep-orange-text text-darken-3">school</i>{{ $questions->count() }} questionnaire{{ plural_string($questions) }}
                            </a>
                        </span>
                        <span class="panel-item valign-wrapper"><i class="material-icons left light-green-text">chat</i>{{ $comments }} commentaire{{ plural_string($comments) }}</span>
                        <span class="panel-item valign-wrapper">
                            <a href="{{ route('students.index') }}">
                                <i class="material-icons left brown-text">people</i>{{ $students }} élève{{ plural_string($students) }}
                            </a>
                        </span>
                    </div>
                </article>

            </section>
        </div>
    </div>
@endsection