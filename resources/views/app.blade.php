<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>@yield('title')Универсальные бойцы Екатерибург</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

  <meta name="description" content="@yield('meta-description') Универсальные бойцы, Екатеринбург.">
  <meta name="keywords" content="@yield('meta-keywords') универсальные бойцы, бойцы екатерибург, универсальные бойцы екатеринбург">
  <meta name="og:locale" content="ru_RU">
  <meta name="csrf-token" content="{{ csrf_token() }}">

	@yield('meta-soc')

	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="/bower_components/owl.carousel/dist/assets/owl.carousel.min.css">
	<link rel="stylesheet" href="/bower_components/owl.carousel/dist/assets/owl.theme.default.min.css">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
	<link rel="stylesheet" href="{{ elixir('css/app.css') }}">
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
					<li><a class="nav-control" href="{{ route('news.dashboard') }}" data-nav-section="news"><span>Новости</span></a></li>
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
					<li><a href="{{ route('news.dashboard') }}" data-nav-section="news"><span>Новости</span></a></li>
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

{{-- Start feedback --}}
<div id="feedback" onclick="showFeedback()">
	<div class="feedback-circle"></div>
	<div class="feedback-fill"></div>
	<div class="feedback-icon">
		<span class="glyphicon glyphicon-earphone"></span>
	</div>
</div>
{{-- End feedback --}}

<script src="/bower_components/jquery/dist/jquery.min.js"></script>
<script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/bower_components/owl.carousel/dist/owl.carousel.min.js"></script>
<script src="/bower_components/waypoints/lib/jquery.waypoints.min.js"></script>
<script src="{{ elixir('js/app.js') }}"></script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-81641304-1', 'auto');
  ga('send', 'pageview');

</script>
<!-- Yandex.Metrika counter --> <script type="text/javascript"> (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter38753525 = new Ya.Metrika({ id:38753525, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true, trackHash:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks"); </script> <noscript><div><img src="https://mc.yandex.ru/watch/38753525" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->
</body>
</html>
