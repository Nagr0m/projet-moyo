<header>
    <nav class="white z-depth-0 main-nav">
        <div class="nav-wrapper">
            <ul class="left">
                <li><a href="#" data-activates="side-nav" class="button-collapse"><i class="material-icons">menu</i></a></li>
                <li class="hide-on-med-and-down">
                    <a href="{{ route('home') }}" class="btn-flat">
                        <i class="material-icons left">navigate_before</i>Retour au site
                    </a>
                </li>
            </ul>
            <ul class="right user-nav">
                <li>
                <a class="dropdown-button btn-flat" data-activates="dropdownUser" data-beloworigin="true"><i class="material-icons left">account_circle</i>{{ $user->username }}</a></li>
            </ul>
        </div>
    </nav>
    <ul id="dropdownUser" class="dropdown-content z-depth-0">
        <li><a href="{{ route('logout') }}"><i class="material-icons">highlight_off</i>Déconnexion</a></li>
    </ul>
</header>