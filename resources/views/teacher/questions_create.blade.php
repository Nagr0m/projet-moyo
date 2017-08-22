@extends('layouts.back')

@section('title', 'Créer un nouveau questionnaire')

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
            <form method="post" action="{{ route('questions.store') }}" id="questionForm">
                {{ csrf_field() }}
                <section class="col s12 m4 push-m8">
                    <div class="panel">
                        <div class="panel-content row">
                            <div class="input-field col s12 @if($errors->has('class_level'))invalid @endif" data-error="{{$errors->first('class_level')}}">
                                <select name="class_level" id="class_level">
                                    <option disabled selected>Choisir un niveau</option>
                                    <option value="first_class">Première</option>
                                    <option value="final_class">Terminale</option>
                                </select>
                                <label for="class_level">Niveau (obligatoire)</label>
                            </div>
                            <div class="input-field col s12 @if($errors->has('published')) invalid @endif" data-error="{{$errors->first('published')}}">
                                <select name="published" id="published">
                                    <option value="1">Publié</option>
                                    <option value="0" selected>Non publié</option>
                                </select>
                                <label for="published">Statut (obligatoire)</label>
                            </div>
                            <div class="input-field col s12 center-align">
                                <button type="submit" class="btn green z-depth-0">Enregistrer</button>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="col s12 m8 pull-m4">
                    <div class="panel row">
                        <div class="panel-head deep-orange-text text-darken-3 col s12">
                            <i class="material-icons left">school</i>Créer un nouveau questionnaire
                        </div>
                        <div class="divider"></div>
                        <div class="panel-content">
                            <div class="input-field col s12 @if($errors->has('title'))invalid @endif" data-error="{{$errors->first('title')}}">
                                <input type="text" name="title" id="title" value="{{ old('title') }}">
                                <label for="title">Titre (obligatoire)</label>
                            </div>
                            <div class="input-field col s12 @if($errors->has('content')) invalid @endif" data-error="{{$errors->first('content')}}">
                                <textarea id="content" name="content" class="materialize-textarea @if($errors->has('content')) invalid @endif">{{ old('content') }}</textarea>
                                <label for="content">Énoncé (obligatoire)</label>
                            </div>
                        </div>
                        <div class="panel-head deep-orange-text text-darken-3 col s12">
                            <i class="material-icons left">help_outline</i>Questions
                            <a class="btn-flat waves-effect waves-green addQuestion"><i class="material-icons left">add</i>Ajouter</a>
                        </div>
                        <div class="divider"></div>
                        <div class="panel-content row">
                            <div class="col s12" id="questionsContainer">
                                
                            </div>
                            <div class="col s12">
                                <p>
                                    <a class="btn-flat waves-effect waves-green right" id="delQuestion"><i class="material-icons left">close</i>Supprimer</a>
                                    <a class="btn-flat waves-effect waves-green right addQuestion"><i class="material-icons left">add</i>Ajouter</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </section>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script src="{{ URL::asset('js/formQuestions.js') }}"></script>
@endsection