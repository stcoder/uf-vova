<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Универсальные бойцы</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="/bower_components/owl.carousel/dist/assets/owl.carousel.min.css">
	<link rel="stylesheet" href="/bower_components/owl.carousel/dist/assets/owl.theme.default.min.css">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
	<link rel="stylesheet" href="/css/app.css">
</head>
<body>

{{-- Start nav --}}
<div class="navbar-container @if(Route::getCurrentRoute()->getName() !== 'home') navbar-static-top @endif">
	<div class="container">
		<nav class="navbar navbar-default">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="/"><img src="{{ asset('/images/logo.png') }}" width="50px">Универсальные бойцы</a>
			</div>
			<div id="navbar" class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-right">
					<li><a class="nav-control" href="/#about" data-nav-section="about"><span>О клубе</span></a></li>
					<li><a class="nav-control" href="/#price" data-nav-section="price"><span>Расписание и стоимость</span></a></li>
					<li><a class="nav-control" href="/#posts" data-nav-section="posts"><span>Лента событий</span></a></li>
					<li><a class="nav-control" href="/#reviews" data-nav-section="reviews"><span>Отзывы</span></a></li>
					<li><a class="nav-control" href="/#contacts" data-nav-section="contacts"><span>Контакты</span></a></li>
				</ul>
			</div>
		</nav>
	</div>
</div>
{{-- End nav --}}

<div class="content">
@yield('content')
</div>

{{-- Start footer --}}
<div id="footer" class="footer-container">
	<div class="footer">
			<div class="container">
			<div class="col-sm-4">
				<ul class="footer-links list-unstyled">
					<li><a href="/#about" data-nav-section="about"><span>О клубе</span></a></li>
					<li><a href="/#price" data-nav-section="price"><span>Расписание и стоимость</span></a></li>
					<li><a href="/#posts" data-nav-section="posts"><span>Лента событий</span></a></li>
					<li><a href="/#reviews" data-nav-section="reviews"><span>Отзывы</span></a></li>
					<li><a href="/#contacts" data-nav-section="contacts"><span>Контакты</span></a></li>
				</ul>
			</div>
			<div class="col-sm-4">
				<div class="footer-logo-container text-center">
					<a href="/" class="footer-logo">
						<img src="{{ asset('images/logo-big.png') }}" class="footer-logo-img">
						<p class="footer-logo-title">Универсальные бойцы</p>
						<p class="footer-logo-subtitle">город Екатеринбург</p>
					</a>
					<p>© {{ date('Y') }}</p>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="pull-right">
					<div class="footer-phone">+7 (982) 639-75-18</div>
					<ul class="footer-socials list-unstyled">
			          <li><a target="_blank" href="https://vk.com/universalfightersekb"><i class="fa fa-vk"></i></a></li>
			          <li><a target="_blank" href="https://www.facebook.com/%D0%A3%D0%BD%D0%B8%D0%B2%D0%B5%D1%80%D1%81%D0%B0%D0%BB%D1%8C%D0%BD%D1%8B%D0%B5-%D0%B1%D0%BE%D0%B9%D1%86%D1%8B-%D0%95%D0%BA%D0%B0%D1%82%D0%B5%D1%80%D0%B8%D0%BD%D0%B1%D1%83%D1%80%D0%B3-1501676683493080/"><i class="fa fa-facebook"></i></a></li>
			          <li><a target="_blank" href="https://www.instagram.com/universal_fighters_ekb/"><i class="fa fa-instagram"></i></a></li>
			        </ul>
				</div>
			</div>
		</div>
	</div>
</div>
{{-- End footer --}}

{{-- Start modal --}}
<div id="modal" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"></h4>
			</div>
			<div class="modal-body"></div>
		</div>
	</div>
</div>
{{-- End modal --}}

<script src="/bower_components/jquery/dist/jquery.min.js"></script>
<script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/bower_components/owl.carousel/dist/owl.carousel.min.js"></script>
<script src="/bower_components/waypoints/lib/jquery.waypoints.min.js"></script>
<script src="/js/app.js"></script>
</body>
</html>