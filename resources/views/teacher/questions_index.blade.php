@extends('layouts.back')

@section('title', 'Tous les questionnaires')

@section('content')

    <div class="section">
        <div class="row">
        
            <div class="col s12 frontErrors" style="display:none">
                <div class="panel col s12">
                    <div class="panel-content">
                        {{-- Error message --}}
                    </div>
                </div>
            </div>
             @if (count($questions) > 0)
                <form method="post" action="{{ route('questions.multiple') }}" id="massForm">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <input type="hidden" name="resource" value="ces questionnaires">
            @endif
                <section class="col s12">
                    <div class="panel">

                        <div class="panel-head">
                            <div class="deep-orange-text text-darken-3">
                                <i class="material-icons left">school</i>Tous les questionnaires
                                <a class="btn-flat waves-effect waves-green z-depth-0" href="{{ route('questions.create') }}">
                                    <i class="material-icons left">add</i>
                                    Ajouter
                                </a>
                            </div>

                            @if (count($questions) > 0)
                                <div class="ressource-options valign-wrapper left-align">
                                    <div class="input-field col s6 m3">
                                        <select name="operation">
                                            <option value="" disabled selected>Action groupée</option>
                                            <option value="publish">Publier</option>
                                            <option value="unpublish">Brouillon</option>
                                            <option value="delete">Supprimer</option>
                                        </select>
                                    </div>
                                    <div class="col s6 m3">
                                        <button class="btn green z-depth-0">Appliquer</button>
                                    </div>
                                </div>
                            @endif

                        </div>
                        <div class="divider"></div>
                        <div class="panel-content row">

                            @if (count($questions) > 0)
                                <table class="bordered responsive-resources">
                                    <thead>
                                        <th>
                                            <input type="checkbox" class="filled-in" id="checkToggle">
                                            <label for="checkToggle">&nbsp;</label>
                                        </th>
                                        <th>Titre</th>
                                        <th>Date de création</th>
                                        <th>Participations</th>
                                        <th>Publié</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($questions as $question)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" id="check{{$question->id}}" class="filled-in" name="items[]" value="{{$question->id}}">
                                        <label for="check{{$question->id}}">&nbsp;</label>
                                                </td>
                                                <td>
                                                    <a href="{{ route('questions.edit', $question->id) }}">{{ $question->title }}</a>
                                                </td>
                                                <td>
                                                    <b>{{ $question->created_at->format('d/m/Y') }}</b>
                                                </td>
                                                <td>
                                                    <i class="material-icons left">people</i>
                                                    {{ $question->done_count }}/{{ $question->scores_count }}
                                                </td>
                                                <td class="@if($question->published) green-text @else red-text @endif">
                                                    <i class="material-icons">label</i>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                Aucun questionnaire
                            @endif
                        </div>
                    </div>
                </section>
            @if (count($questions) > 0)
                </form>
            @endif
        </div>
    </div>

@endsection

@section('scripts')
    @parent
    <script src="{{ URL::asset('js/massOperations.js') }}"></script>
@endsection