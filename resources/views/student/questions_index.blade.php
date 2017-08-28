@extends('layouts.back')

@section('title', 'Tous les questionnaires')

@section('content')

    {{-- Modale de félicitation --}}
    @if(Session::get('note'))
        @php
            $percent = notePercent(Session::get('note'), Session::get('choicesCount'));
        @endphp
        <div id="formfinish" class="modal">
            <div class="modal-content">
                @if($percent <= 20)
                    <h4><i class="material-icons left">sentiment_very_dissatisfied</i>Il va falloir vous mettre à travailler</h4>
                @elseif($percent > 20 && $percent <= 40)
                    <i class="material-icons left">sentiment_dissatisfied</i>
                    Effort insuffisant
                @elseif($percent > 40 && $percent <= 60)
                    <i class="material-icons left">sentiment_neutral</i>
                    Peu mieux faire
                @elseif($percent > 60 && $percent <= 80)
                    <i class="material-icons left">sentiment_satisfied</i>
                    Encore un effort
                @elseif($percent > 80 && $percent <= 100)
                    <i class="material-icons left">sentiment_very_satisfied</i>
                    Félicitations
                @endif
                <p>Vous avez fini le questionnaire avec une note de {{ Session::get('note') }} / {{ Session::get('choicesCount') }} soit {{ $percent }}% de bonnes réponses</p>
            </div>
            <div class="modal-footer">
                <a style="cursor: pointer;" class="modal-action modal-close waves-effect waves-cyan btn-flat">Continuer</a>
            </div>
        </div>
    @endif

    <div class="section">
        <div class="row">
            <section class="col s12">
                <div class="panel">
                    <div class="panel-head">
                        <div class="light-blue-text">
                            <i class="material-icons left">description</i>Tous les questionnaires
                        </div>
                    </div>
                    <div class="divider"></div>
                    <div class="panel-content row">
                        @if($scores->count() > 0)
                            <table class="bordered responsive-resources">
                                <thead>
                                    <th width="10"></th>
                                    <th>Titre</th>

                                    <th>Note</th>
                                </thead>
                                <tbody>
                        @endif
                        @forelse($scores as $score)
                            <tr id="">
                                <td>
                                    <i class="tiny material-icons left @if($score->done) light-green-text text-accent-4 @else red-text @endif">brightness_1</i>
                                </td>
                                <td>
                                    {{$score->question->title}}
                                </td>
                                <td>
                                    @if($score->done == 0)
                                        <a class="btn cyan z-depth-0" href="{{ route('student/question', $score->question->id) }}">Répondre</a>
                                    @else
                                        {{ $score->note }} / {{ $score->question->choicesCount }}
                                    @endif
                                </td>
                            </tr>
                        @empty
                            Aucun questionnaire
                        @endforelse

                        @if($scores->count() > 0)
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection