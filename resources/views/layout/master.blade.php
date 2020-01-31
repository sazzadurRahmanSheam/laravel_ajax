<!DOCTYPE html>
<html>
<head>
	<title>Ajax | @yield('title')</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('public/css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/css/font-awesome.css') }}">
	@yield('addStyle')
</head>
<body>
	<div class="container">
		@yield('content')
	</div>

	<script type="text/javascript" src="{{ asset('public/js/jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/js/bootstrap.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/js/popper.min.js') }}"></script>
	@yield('addScript')
</body>
</html>