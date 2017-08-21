@extends('layouts.back')

@section('title', 'Répondre au questionnaire')

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
            <form method="post" action="{{ route('student/questions') }}" id="questionForm">
                {{ csrf_field() }}
                <section class="col s12 m4 push-m8">
                    <div class="panel">
                        <div class="panel-content row">
                            <div class="input-field col s12 center-align">
                                <button type="submit" class="btn green z-depth-0">Enregistrer</button>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="col s12 m8 pull-m4">
                    <div class="panel row">
                        <div class="panel-head deep-orange-text text-darken-3 col s12">
                            <i class="material-icons left">help_outline</i><p>{{ $question->title }}</p>
                        </div>
                        <div class="divider"></div>

                        <div class="panel-content row">
                            <div class="col s12">
                                <p>{{ $question->content }}</p>
                            </div>
                            <div class="col s12" id="questionsContainer">
                                {{-- boucle des choix --}}
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
@endsection