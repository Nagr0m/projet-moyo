<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>MoYo - @yield('title')</title>

	<!-- Styles -->
	<link rel="stylesheet" href="{{ URL::asset('css/grillade.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('css/front.css') }}">

</head>
<body>
	<header class="header">
		@include('partials.front_header')
	</header>
	
	<div class="container">
		<div class="grid">
			<div class="content three-quarters">
				@yield('content')
			</div>
			<aside class="sidebar one-quarter">
				@include('partials.sidebar')
			</aside>
		</div>
	</div>

	@include('partials.footer')

	@section('scripts')
		{{-- Widget Twitter --}}
		<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
	@show
</body>
</html>