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
</head>
<style>
    html, body, .container {
        height: 100%;
    }
</style>
<body>
    
    <main class='container valign-wrapper'>
         <div class='row' style="width: 100%">
            <div class="col s12 m6 offset-m3">
                <div class='card'>
                    <div class="card-content container">
                        <h3 class="center-align light">Se connecter</h3>
                        <form method="post" method="{{ route('login') }}">
                            <br>
                            {{ csrf_field() }}
                            <div class="input-field">
                                <input id="username" name="username" type="text" @if($errors->has('username')) class="invalid" @endif>
                                <label for="username" data-error="{{ $errors->first('username') }}" >Nom d'utilisateur (prénom)</label>
                            </div>
                            <div class="input-field">
                                <input id="password" name="password" type="password" @if($errors->has('password')) class="invalid" @endif>
                                <label for="password" data-error="{{ $errors->first('password') }}">Mot de passe</label>
                            </div>
                            <input type="submit" value="Connexion" class="btn">
                        </form>
                    </div>
                </div>
                <a class="waves-effect waves-teal btn-flat" href="#" ><i class="material-icons left">navigate_before</i>Retour sur le site</a>
            </div>
        </div> 
    </main>

    <script src="http://code.jquery.com/jquery-3.2.1.min.js"></script>
    {{-- MaterializeJS --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.1/js/materialize.min.js"></script>
</body>
</html>