<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>MoYo - @yield('title')</title>

    {{-- MaterializeCSS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.1/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('css/back.css') }}">
</head>
<body id="back" class="grey-text text-darken-4">

    @include('partials.back_header')

    {{-- Sidebar --}}
    @if(classActivePath('teacher'))
        @include('partials.teacher_sidebar')
    @elseif(classActivePath('student'))
        @include('partials.student_sidebar')
    @endif

    <main class="wrapper">
        @yield('content')
    </main>

    {{-- Modale de suppression --}}
    <div id="confirmMaterial" class="modal bottom-sheet">
		<div class="modal-content">
			<h4>Voulez-vous supprimer <span class="modalResource"></span> ?</h4>
			<p>Cette action est irréversible.</p>
		</div>
		<div class="modal-footer">
			<a style="cursor: pointer;" class="modal-action modal-close waves-effect waves-green btn-flat">Non</a>
			<a style="cursor: pointer;" id="confirmModal" class="waves-effect red darken-1 white-text btn-flat">Oui</a>
		</div>
	</div>

    @section('scripts')
        {{-- MaterializeJS & jQuery --}}
        <script src="http://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.1/js/materialize.min.js"></script>
        
        <script src="{{ URL::asset('js/teacher-main.js') }}"></script>

        @if(Session::get('message'))
            <script>
                let message = "<?php echo Session::get('message');?>"
                Materialize.toast(message, 4000, 'rounded')
            </script>
	    @endif
    @show
</body>
</html>