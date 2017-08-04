<aside>
    <div id="side-nav" class="side-nav z-depth-0 fixed">

        <div class="layer">
            <div class="wrapper white-text">

                <div class="side-head">Lycée MoYo</div>
                <div class="divider white"></div>
                <ul>
                    <li {{ classActivePath('dashboard') }}>
                        <a href="{{ route('student/home') }}"><i class="material-icons">home</i>Accueil</a>
                    </li>
                    <li {{ classActivePath('questions') }}>
                        <a href="{{ route('student/questions') }}"><i class="material-icons">school</i>Questionnaires</a>
                    </li>
                </ul>
                
            </div>
        </div>
        
    </div>
</aside>