@extends ('layouts.back')
@section ('title', 'Tous les étudiants')

@section ('content')
    <div class="section">
        <div class="row">

            <div class="col s12 m6">
                <div class="panel">
                    <div class="panel-head center-align">
                        <h4>Élèves de première</h4>
                    </div>
                    <div class="divider"></div>
                    <div class="panel-content">
                        @forelse ($students['first_class'] as $student)
                            <p>{{ $student->username }}</p>
                        @empty

                        @endforelse
                    </div>
                </div>
            </div>
            

            <div class="col s12 m6">
                <div class="panel">
                    <div class="panel-head center-align">
                        <h4>Élèves de terminale</h4>
                    </div> 
                    <div class="divider"></div>
                    <div class="panel-content">
                        @forelse ($students['final_class'] as $student)
                            <p>{{ $student->username }}</p>
                        @empty

                        @endforelse
                    </div>                 
                </div>
            </div>
        </div>
    </div>
@endsection