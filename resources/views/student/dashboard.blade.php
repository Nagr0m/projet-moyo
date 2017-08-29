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
                        @forelse($scores->where('done', false)   as $score)
                            <span class="panel-item valign-wrapper">
                                <a href="{{ route('student/question', $score->question->id) }}">
                                     <i class="tiny material-icons left @if($score->done) light-green-text text-accent-4 @else red-text @endif">brightness_1</i>
                                     {{ $score->question->title }}
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
                        <span class="panel-item valign-wrapper">
                            <i class="material-icons left cyan-text text-darken-3">timeline</i>Note global : {{ $totalScore }} / {{ $totalAnsweredChoices }}
                        </span>
                        <span class="panel-item valign-wrapper">
                            <i class="material-icons left cyan-text text-darken-2">thumbs_up_down</i>{{ notePercent($totalScore, $totalAnsweredChoices) }} % de réussite
                        </span>
                        <span class="panel-item valign-wrapper">
                            <i class="material-icons left cyan-text text-darken-1">compare_arrows</i>{{ notePercent($scores->where('done', true)->count(), $scores->count()) }} % d'avancement
                        </span>
                    </div>
                    <div class="panel-content col s12 l6">
                        <span class="panel-item valign-wrapper">
                            <i class="material-icons left cyan-text text-darken-1">view_headline</i>{{ $scores->count() }} questionnaire{{ plural_string($scores) }} en tout
                        </span>
                        <span class="panel-item valign-wrapper">
                            <i class="material-icons left cyan-text text-darken-2">crop_square</i>{{ $scores->where('done', false)->count() }} questionnaire{{ plural_string($scores->where('done', false)) }} à faire
                        </span>
                        <span class="panel-item valign-wrapper">
                            <i class="material-icons left cyan-text text-darken-3">done</i>{{ $scores->where('done', true)->count() }} questionnaire{{ plural_string($scores->where('done', true)) }} terminé{{ plural_string($scores->where('done', true)) }}
                        </span>
                    </div>
                </article>

            </section>
        </div>
    </div>
@endsection