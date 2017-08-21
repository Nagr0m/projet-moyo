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

            <section class="col s12">
                <div class="panel">

                    @if (count($questions) > 0)
                        <form method="post" action="{{ route('questions.multiple') }}" id="massForm">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            <input type="hidden" name="resource" value="ces questionnaires">
                    @endif

                    <div class="panel-head">
                        <div class="deep-orange-text text-darken-3">
                            <i class="material-icons left">school</i>Tous les questionnaires
                            <a class="btn-flat waves-effect waves-green z-depth-0" href="{{ route('questions.create') }}">
                                <i class="material-icons left">add</i>
                                Ajouter
                            </a>
                        </div>

                        
                            

                            
                        
                    </div>

                    @if (count($questions) > 0)
                        </form>
                    @endif

                </div>
            </section>

        </div>
        
        @forelse($questions as $question)
            <p>
                <a href="{{ route('questions.edit', $question->id) }}">
                    {{ $question->content }}
                </a> @if($question->published) published @else unpublished @endif 
                <form action="{{ route('questions.destroy', $question->id) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <a class="destroy" data-resource="ce questionnaire">delete</a>
                </form>
            </p>
        @empty
            Aucun questionnaire
        @endforelse
    </div>

@endsection