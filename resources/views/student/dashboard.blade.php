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
                        @if(count($questionsAll) > 0)
                            <div class="panel-title">Vos questionnaires à faire</div>
                        @endif
                        @forelse($questionsAll as $question)
                            <span class="panel-item valign-wrapper">
                                <a href="">
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
            </section>

            <section class="col s12 l6">
                <article class="panel">
                    <div class="panel-head blue-grey-text">
                        <i class="material-icons left">poll</i>Statistiques
                    </div>
                    <div class="divider"></div>
                    <div class="panel-content">
                        <span class="panel-item valign-wrapper">
                            <i class="material-icons left deep-orange-text text-darken-3">school</i>{{ $questionsAll->count() }} questionnaire{{ plural_string($questionsAll) }}
                        </span>
                        <span class="panel-item valign-wrapper">
                            <i class="material-icons left deep-orange-text text-darken-3">school</i>{{ $questionsDone->count() }} questionnaire{{ plural_string($questionsDone) }} terminé{{ plural_string($questionsDone) }}
                        </span>
                    </div>
                </article>

            </section>
        </div>
    </div>
@endsection