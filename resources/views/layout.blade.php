<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Laravel - Vue - Todos</title>
		<link rel="stylesheet" type="text/css" href="{{asset('css/vendors.min.css')}}">
		<link rel="stylesheet" type="text/css" href="{{asset('css/style.bundle.css')}}">
	</head>
	<body>
		
		@yield('content')
		<script src="{{asset('js/vendors.min.js')}}"></script>
		@include('laravel')
		@yield('js')
		
	</body>
</html>