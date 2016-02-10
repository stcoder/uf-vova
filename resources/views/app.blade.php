<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel</title>

	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-social/4.11.0/bootstrap-social.min.css">
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.7.6/jquery.fullPage.min.css">
	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-static-top navbar-inverse">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navbar-collapse" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Универсальные бойцы</a>
			</div>

			<div class="collapse navbar-collapse" id="main-navbar-collapse">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#">О клубе</a></li>
					<li><a href="#">Расписание и стоимость</a></li>
					<li><a href="#">Лента событий</a></li>
					<li><a href="#">Медиа</a></li>
					<li><a href="#">Контакты</a></li>
				</ul>
			</div>
		</div>
	</nav>

	@yield('content')

	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.7.6/vendors/jquery.easings.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.7.6/vendors/jquery.slimscroll.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.7.6/jquery.fullPage.min.js"></script>
	<script src="{{ asset('/js/app.js') }}"></script>
</body>
</html>
