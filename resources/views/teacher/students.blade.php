@extends ('layouts.back')
@section ('title', 'Tous les étudiants')

@section ('content')
    <div class="section">
        <div class="row">

            <div class="col s12 m6">
                <div class="panel">
                    <div class="panel-head center-align">
                        <h4>Élèves de première</h4>
                        <p>Score total</p>
                    </div>
                    <div class="divider"></div>
                    <div class="panel-content">
                        @forelse ($students['first_class'] as $student)
                            <span class="students">
                                <div>
                                    {{ $student->username }} - {{ $ScoreRepository->totalScore($student->id) }}/{{ $ScoreRepository->totalAnsweredChoices($student->id) }}  
                                </div>
                                <div>
                                    ({{ $student->scores->where('done', true)->count() }} questionnaire{{ plural_string($student->scores->where('done', true)->count()) }} fait{{ plural_string($student->scores->where('done', true)->count()) }})
                                </div>
                            </span>
                            @if (!$loop->last)
                                <div class="divider"></div>
                            @endif
                        @empty
                            Aucun élève de première d'enregistré
                        @endforelse
                    </div>
                </div>
            </div>
            

            <div class="col s12 m6">
                <div class="panel">
                    <div class="panel-head center-align">
                        <h4>Élèves de terminale</h4>
                        <p>Score total</p>
                    </div> 
                    <div class="divider"></div>
                    <div class="panel-content">
                        @forelse ($students['final_class'] as $student)
                            <span class="students">
                                <div>
                                    {{ $student->username }} - {{ $ScoreRepository->totalScore($student->id) }}/{{ $ScoreRepository->totalAnsweredChoices($student->id) }} 
                                </div>
                                <div>
                                    ({{ $student->scores->where('done', true)->count() }} questionnaire{{ plural_string($student->scores->where('done', true)->count()) }} fait{{ plural_string($student->scores->where('done', true)->count()) }})
                                </div>
                            </span>
                            @if (!$loop->last)
                                <div class="divider"></div>
                            @endif
                        @empty
                            Aucun élève de terminale d'enregistré
                        @endforelse
                    </div>                 
                </div>
            </div>
        </div>
    </div>
@endsection