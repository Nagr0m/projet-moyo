<aside>
    <div id="side-nav" class="side-nav z-depth-0 fixed">

        <div class="layer">
            <div class="wrapper white-text">

                <div class="side-head">Administration</div>
                <div class="divider white"></div>
                <ul>
                    <li {{ classActivePath('dashboard') }}>
                        <a href=""><i class="material-icons">home</i>Accueil</a>
                    </li>
                    <li {{ classActivePath('posts') }}>
                        <a href="{{ route('posts.index') }}"><i class="material-icons">description</i>Articles</a>
                    </li>
                    <li {{ classActivePath('questions') }}>
                        <a href="{{ route('questions.index') }}"><i class="material-icons">school</i>Questionnaires</a>
                    </li>
                    <li {{ classActivePath('students') }}>
                        <a href="{{ route('students.index') }}"><i class="material-icons">people</i>Élèves</a>
                    </li>
                </ul>
                
            </div>
        </div>
        
    </div>
</aside>