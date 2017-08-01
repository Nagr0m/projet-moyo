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
<body id="back">

    @include('partials.back_header')

    <aside>
        <ul id="side-nav" class="side-nav fixed">
            <li>THis is the sidebar</li>
        </ul>
    </aside>

    @section('scripts')
        <script src="http://code.jquery.com/jquery-3.2.1.min.js"></script>
        {{-- MaterializeJS --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.1/js/materialize.min.js"></script>
    @show
</body>
</html>