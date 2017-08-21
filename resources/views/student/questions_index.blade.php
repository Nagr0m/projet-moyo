@extends('layouts.back')

@section('title', 'Tous les questionnaires')

@section('content')
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
                                    <th>Titre</th>
                                    <th>Enoncé</th>
                                    <th>Note</th>
                                    <th>Terminé</th>
                                </thead>
                                <tbody>
                        @endif
                        @forelse($scores as $score)
                            <tr id="">
                                <td>
                                    <a href="{{ route('posts.edit', $score->id) }}">{{$score->question->title}}</a>
                                </td>
                                <td>
                                    {{ $score->question->content }}
                                </td>
                                <td>
                                    {{ $score->note }}
                                </td>
                                <td>
                                    <i class="tiny material-icons left @if($score->done) light-green-text text-accent-4 @else red-text @endif">brightness_1</i>
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

@section('scripts')
    @parent
@endsection