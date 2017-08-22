<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>MoYo - @yield('title')</title>

	{{-- Normalize and Grid layout --}}
	<link rel="stylesheet" href="{{ URL::asset('utils/css/normalize.min.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('css/grillade.css') }}">
	{{-- Main CSS --}}
	<link rel="stylesheet" href="{{ URL::asset('css/front.css') }}">
</head>
<body>
	@include('partials.front_header')


	<div class="grid">

		<main class="content three-quarters">
			<div class="container">
				@yield('content')
			</div>
		</main>
		
		<aside class="sidebar one-quarter">
			<div class="container">
			@include('partials.sidebar')
			</div>
		</aside>
	</div>


	@include('partials.footer')

	@section('scripts')
		{{-- Widget Twitter --}}
		<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
	@show
</body>
</html>