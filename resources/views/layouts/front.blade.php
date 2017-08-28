<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>MoYo - @yield('title')</title>

	{{-- Vendor CSS --}}
	<link rel="stylesheet" href="{{ URL::asset('utils/css/normalize.min.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('css/grillade.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('utils/css/typicons.min.css') }}">
	{{-- Google Fonts --}}
	<link href="https://fonts.googleapis.com/css?family=Nunito:400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
	{{-- Main CSS --}}
	<link rel="stylesheet" href="{{ URL::asset('css/front.css') }}">
</head>
<body>
	@include('partials.front_header')

	<div class="grid">
		<main class="three-quarters">
			<div class="content-wrapper">
				@yield('content')
			</div>
			
			@include('partials.footer')
		</main>
		
		<aside class="sidebar one-quarter">
			<div class="container">
			@include('partials.sidebar')
			</div>
		</aside>
	</div>

	@section('scripts')
		{{-- Widget Twitter --}}
		<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
		{{-- Widget Facebook --}}
		<div id="fb-root"></div>
		<script>
		(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0]
  			if (d.getElementById(id)) return;
  			js = d.createElement(s); js.id = id
			js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.10&appId=290779247605782"
  			fjs.parentNode.insertBefore(js, fjs)
			}(document, 'script', 'facebook-jssdk'))
		</script>
	@show
</body>
</html>