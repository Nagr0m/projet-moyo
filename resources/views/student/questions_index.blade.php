@extends('layouts.back')

@section('title', 'Tous les questionnaires')

@section('content')

    {{-- Modale de félicitation --}}
    @if(null !==Session::get('note'))
        @php
            $percent = notePercent(Session::get('note'), Session::get('choicesCount'));
        @endphp
        @if($percent == 100)
            <div class="pyro">
                <div class="before"></div>
                <div class="after"></div>
            </div>
        @endif
        <div id="formfinish" class="modal">
            <div class="modal-content">
                @if($percent <= 20)
                    <h4 class="red-text text-accent-4"><i class="material-icons left">sentiment_very_dissatisfied</i>Il va falloir vous mettre à travailler !</h4>
                @elseif($percent > 20 && $percent <= 40)
                     <h4 class="orange-text text-accent-4"><i class="material-icons left">sentiment_dissatisfied</i>Vous n'y est pas encore, continuez !</h4>
                @elseif($percent > 40 && $percent <= 60)
                     <h4 class="amber-text text-accent-4"><i class="material-icons left">sentiment_neutral</i>C'est un début, mais il faut faire un effort !</h4>
                @elseif($percent > 60 && $percent <= 80)
                     <h4 class="light-green-text text-accent-4"><i class="material-icons left">sentiment_satisfied</i>Vous vous en sortez bien, continuez !</h4>
                @elseif($percent > 80 && $percent < 100)
                     <h4 class="green-text text-accent-4"><i class="material-icons left">sentiment_very_satisfied</i>Félicitations, vous avez fait un très bon score</h4>
                @elseif($percent == 100)
                     <h4 class="green-text text-accent-4"><i class="material-icons left red-text text-accent-4">whatshot</i>Incroyable !!</h4>
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

                            <table class="bordered responsive-resources">
                                <thead>
                                    <th width="3%"></th>
                                    <th width="37%">Titre</th>

                                    <th width="30%">Note</th>
                                    <th width="30%">Date de création</th>
                                </thead>
                                <tbody>

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
                                <td>{{ $score->question->created_at }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan=4>Aucun questionnaire</td>
                            </tr>
                        @endforelse


                                </tbody>
                            </table>

                        {{ $scores->links('vendor.pagination.student') }}
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection