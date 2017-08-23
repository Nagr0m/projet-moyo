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
                        @if($scores->count() > 0)
                            <div class="panel-title">Vos questionnaires à faire</div>
                        @endif
                        @forelse($scores as $score)
                            <span class="panel-item valign-wrapper">
                                <a href="{{ route('student/question', $score->question->id) }}">
                                     <i class="tiny material-icons left @if($score->done) light-green-text text-accent-4 @else red-text @endif">brightness_1</i>
                                     {{ $score->question->content }}
                                </a>
                            </span>
                            @if($loop->iteration === 5)
                                @break
                            @endif
                        @empty
                            Aucun questionnaire
                        @endforelse

                        @if($scores->count() > 0)
                            <div class="center-align">
                                <a class="btn cyan waves-effect waves-light z-depth-0" href="{{ route('student/questions') }}">Tous les questionnaires</a>
                            </div>
                        @endif
                        
                    </div>
                </article>
            </section>

            <section class="col s12 l6">
                <article class="panel row">
                    <div class="panel-head blue-grey-text">
                        <i class="material-icons left">poll</i>Statistiques
                    </div>
                    <div class="divider"></div>
                    <div class="panel-content col s12 l6">
                        <span class="panel-item valign-wrapper"><i class="material-icons left deep-orange-text text-darken-3">school</i></span>
                        <span class="panel-item valign-wrapper"><i class="material-icons left deep-orange-text text-darken-3">school</i></span>
                        <span class="panel-item valign-wrapper"><i class="material-icons left deep-orange-text text-darken-3">school</i></span>
                    </div>
                    <div class="panel-content col s12 l6">
                        <span class="panel-item valign-wrapper">
                            <i class="material-icons left deep-orange-text text-darken-3">school</i>{{ $scores->count() }} questionnaire{{ plural_string($scores) }}
                        </span>
                        <span class="panel-item valign-wrapper">
                            <i class="material-icons left deep-orange-text text-darken-3">school</i>{{ $scores->where('done', false)->count() }} questionnaire{{ plural_string($scores->where('done', false)) }} à faire
                        </span>
                        <span class="panel-item valign-wrapper">
                            <i class="material-icons left deep-orange-text text-darken-3">school</i>{{ $scores->where('done', true)->count() }} questionnaire{{ plural_string($scores->where('done', true)) }} terminé{{ plural_string($scores->where('done', true)) }}
                        </span>
                    </div>
                </article>

            </section>
        </div>
    </div>
@endsection