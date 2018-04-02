<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>@yield('title','Sample')</title>
	</head>
	<body>
		@include('layouts._header')

		@yield('contents')

		@include('layouts._footer')
	</body>
</html>