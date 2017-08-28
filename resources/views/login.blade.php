<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>MoYo - Login</title>

    {{-- MaterializeCSS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.1/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="stylesheet" href="{{ URL::asset('css/back.css') }}">
</head>
<body class="valign-wrapper" id="login">
    
    <div class="container">
         <div class="row">
            <div class="col s12 m10 xl6 offset-m1 offset-xl3">
                <div class="card">
                    <div class="card-content container">
                        <h3 class="center-align light">Se connecter</h3>
                        <form method="post" class="section loginForm" method="{{ route('login') }}" novalidate>
                            {{ csrf_field() }}
                            <div class="input-field @if($errors->has('username')) invalid @endif" data-error="{{$errors->first('username')}}">
                                <input id="username" name="username" type="text" @if($errors->has('username')) class="invalid" @endif value="{{ old('username') }}" required>
                                <label for="username">Nom d'utilisateur (prénom)</label>
                            </div>
                            <div class="input-field @if($errors->has('password')) invalid @endif" data-error="{{$errors->first('password')}}">
                                <input id="password" name="password" type="password" @if($errors->has('password')) class="invalid" @endif value="{{ old('password') }}" required>
                                <label for="password">Mot de passe</label>
                            </div>
                            <div class="center-align section">
                                <button type="submit" class="btn green">Connexion</button>
                            </div>
                        </form>
                    </div>
                </div>
                <a class="waves-effect waves-green btn-flat white-text" href="{{ route('home') }}" ><i class="material-icons left">navigate_before</i>Retour sur le site</a>
            </div>
        </div> 
    </div>

    <script src="http://code.jquery.com/jquery-3.2.1.min.js"></script>
    {{-- MaterializeJS --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.1/js/materialize.min.js"></script>
    <script src="{{ URL::asset('js/formLogin.js') }}"></script>
</body>
</html>