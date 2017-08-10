@extends('layouts.back')

@section('title', 'Modifier un questionnaire')

@section('content')
    <div class="section">
        <div class="row">
            {{-- Front-end validation --}}
            <div class="col s12 frontErrors" style="display:none">
                <div class="panel col s12">
                    <div class="panel-content">
                        Certains champs comportent des erreurs.
                    </div>
                </div>
            </div>
            {{-- Back-end validation --}}
            @if(count($errors) > 0)
                <div class="col s12 backErrors">
                    <div class="panel col s12">
                        <div class="panel-content">
                            Le formulaire comporte des erreurs.
                        </div>
                    </div>
                </div>
            @endif

            <form method="post" action="{{ route('questions.update', $question->id) }}" id="questionForm">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <section class="col s12 m4 push-m8">
                    <div class="panel">
                        <div class="panel-content row">
                            <div class="input-field col s12 @if($errors->has('class_level'))invalid @endif" data-error="{{$errors->first('class_level')}}">
                                <select name="class_level" id="class_level">
                                    <option disabled>Choisir un niveau</option>
                                    <option value="first_class" {{ selected_fields('first_class', oldValue('class_level', $question->class_level), 'selected') }}>Première</option>
                                    <option value="final_class" {{ selected_fields('final_class', oldValue('class_level', $question->class_level), 'selected') }}>Terminale</option>
                                </select>
                                <label for="class_level">Niveau (obligatoire)</label>
                            </div>
                            <div class="input-field col s12 @if($errors->has('published')) invalid @endif" data-error="{{$errors->first('published')}}">
                                <select name="published" id="published">
                                    <option value="1" {{ selected_fields('1', oldValue('published', $question->published), 'selected') }}>Publié</option>
                                    <option value="0" {{ selected_fields('0', oldValue('published', $question->published), 'selected') }}>Non publié</option>
                                </select>
                                <label for="published">Statut (obligatoire)</label>
                            </div>
                            <div class="input-field col s12 center-align">
                                <button type="submit" class="btn green z-depth-0">Mettre à jour</button>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="col s12 m8 pull-m4">
                    <div class="panel row">
                        <div class="panel-head deep-orange-text text-darken-3 col s12">
                            <i class="material-icons left">school</i>Modifier un questionnaire
                        </div>
                        <div class="divider"></div>
                        <div class="panel-content">
                            <div class="input-field col s12 @if($errors->has('content')) invalid @endif" data-error="{{$errors->first('content')}}">
                                <textarea id="content" name="content" class="materialize-textarea @if($errors->has('content')) invalid @endif">{{ oldValue('content', $question->content) }}</textarea>
                                <label for="content">Énoncé (obligatoire)</label>
                            </div>
                        </div>
                        <div class="panel-head deep-orange-text text-darken-3 col s12">
                            <i class="material-icons left">help_outline</i>Questions
                        </div>
                        <div clas="divider"></div>
                        <div class="panel-content row">
                            @foreach($question->choices as $choice)
                                <div class="questionGroup">
                                    <div class="input-field col s12">
                                        <textarea id="question_{{$choice->id}}" name="question[{{$choice->id}}]" class="materialize-textarea">{{ oldValue('question_'.$choice->id, $choice->content) }}</textarea>
                                        <label for="question_{{$choice->id}}">Question {{$loop->iteration}}</label>
                                    </div>
                                    <div class="switch col s12">
                                        <label>
                                            Faux
                                            <input type="checkbox" name="answer[{{$choice->id}}]" {{ selected_fields('yes', oldValue('answer_'.$choice->id, $choice->answer)) }}>
                                            <span class="lever"></span>
                                            Vrai
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    @parent

    <script src="{{ URL::asset('js/questions-form.js') }}"></script>
@endsection