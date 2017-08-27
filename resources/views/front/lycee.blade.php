@extends ('layouts.front')
@section ('title', 'Le lycée')

@section ('content')
    <div class="page-head">
        <div class="container">
            <h2>Le Lycée</h2>
        </div>
    </div>
    <div class="container page-content">
        <img class="page-img" src="{{ URL::asset('img/lycee1.jpg') }}">
        <p>
            Lié à l'histoire de la ville en particulier et du bassin albenassien en général, le lycée Moyo a permis à de nombreuses générations d'effectuer une scolarité réussie. Sa tradition généraliste, présente aujourd'hui avec les Baccalauréats Économique et Social, Littéraire, Scientifique, a été complétée par des enseignements technologiques et professionnels tertiaires. Il offre aussi une poursuite d’études post-bac avec deux sections de techniciens supérieurs.
        </p>
        <img class="page-img" src="{{ URL::asset('img/lycee2.jpg') }}">
        <p>
            Il offre ainsi à plus de 1 000 élèves une formation variée et de qualité. Il permet au plus grand nombre de vivre une scolarité en fonction de ses moyens ou de ses projets. Des parcours adaptés sont mis en place pour que « personne ne soit laissé au bord du chemin », conformément aux objectifs du projet de l'Académie de Grenoble.
        </p>
        <img class="page-img" src="{{ URL::asset('img/lycee3.jpg') }}">
        <p>
            Des options spécifiques validées scolairement et des clubs autorisant une pratique originale et valorisante, permettent l'expression et le développement d'un potentiel personnel.
        </p>
        <img class="page-img" src="{{ URL::asset('img/lycee4.jpg') }}">
        <p>
            La volonté de l’ensemble du personnel est que chacun, à son niveau, avec ses envies, avec son projet, vive un lycée agréable, tremplin pour sa vie d'adulte. Au lycée Moyo, l'élève aura à assurer son métier d'élève, mais il y trouvera une organisation et des personnes prêtes à l'écouter et à l'aider à réussir.
        </p>
    </div>
@endsection