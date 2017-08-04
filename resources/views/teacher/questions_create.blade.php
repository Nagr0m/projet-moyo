@extends('layouts.back')

@section('title', 'Créer un nouveau questionnaire')

@section('content')
    @if(count($errors) > 0)
        {{ dump($errors) }}
        @endif
    <div class="section">
        <div class="row">
            <form method="post" action="{{ route('questions.store') }}">
                {{ csrf_field() }}
                <section class="col s12 m4 push-m8">
                    <div class="panel">
                        <div class="panel-content row">
                            <div class="input-field col s12">
                                <select name="class_level">
                                    <option disabled selected>Choisir un niveau</option>
                                    <option value="first_class">Première</option>
                                    <option value="final_class">Terminale</option>
                                </select>
                                <label for="content">Niveau (obligatoire)</label>
                            </div>
                            <div class="input-field col s12">
                                <select name="published">
                                    <option value="1">Publié</option>
                                    <option value="0" selected>Non publié</option>
                                </select>
                                <label for="content">Statut (obligatoire)</label>
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
                            <div class="input-field col s12">
                                <textarea id="content" name="content" class="materialize-textarea">{{ old('content') }}</textarea>
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
    <script>
        $( () => {
            
            let index = 0
            let questionContainer = $('#questionsContainer')
            let addQuestion       = $('.addQuestion')
            let delQuestion       = $('#delQuestion')

            // Initialisation première question
            createQuestion()

            addQuestion.click(createQuestion)
            delQuestion.click(destroyQuestion)


            function createQuestion () {
                let toIncrement = {
                    id: index,
                    textlabel: 'Question ' + (index + 1)
                }

                let template = '\
                <div class="questionGroup" data-questionid="' + toIncrement.id + '">\
                    <div class="input-field col s12">\
                        <textarea id="question-' + toIncrement.id + '" name="questions[]" class="materialize-textarea"></textarea>\
                        <label for="question-' + toIncrement.id + '">' + toIncrement.textlabel + '</label>\
                    </div>\
                    <div class="switch col s12">\
                        <label>\
                            Faux\
                            <input type="checkbox" name="answer-' + toIncrement.id + '">\
                            <span class="lever"></span>\
                            Vrai\
                        </label>\
                    </div>\
                </div>'

                $(questionContainer).append(template)

                index++;
            }

            function destroyQuestion () {
                index--
                if (index < 0) index = 0
                $( '.questionGroup[data-questionid='+ index +']' ).remove()
            }

        })
    </script>
@endsection