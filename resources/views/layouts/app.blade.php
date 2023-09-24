<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>@yield('title', 'Nobelium')</title>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
		<link rel="stylesheet" href="{{ url('/css/nobelium.min.css') }}">
		<link rel="stylesheet" href="{{ url('/css/main.css?v=1.48') }}">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
		<script src="{{ url('/js/bootstrap.min.js') }}"></script>
		@yield('header')
		@yield('css')
	</head>
	<body>
		<nav class="navbar navbar-inverse navbar-static-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
						<span class="sr-only">Toggle Navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>

					<a class="navbar-brand" href="{{ url('/') }}">
						Nobelium
					</a>
				</div>

				<div class="collapse navbar-collapse" id="app-navbar-collapse">
					<ul class="nav navbar-nav">
						@if (Auth::check())
							<li><a href="{{ url('/user/' . Auth::user()->id) }}">Profile</a></li>
						@else
							<li><a href="{{ url('/') }}">Home</a></li>
						@endif
						<li><a href="{{ url('/forums') }}">Forums</a></li>
						@if (Auth::check())
							<li><a href="{{ url('/games') }}">Games</a></li>
							<li><a href="{{ url('/downloads') }}">Downloads</a></li>
							<li><a href="{{ url('/catalog') }}">Catalog</a></li>
							<li><a href="{{ url('/users') }}">Users</a></li>
						@endif
					</ul>

					<ul class="nav navbar-nav navbar-right">
						@if (Auth::guest())
							<li><a href="{{ url('/login') }}">Login</a></li>
							<li><a href="{{ url('/register') }}">Register</a></li>
						@else
							<li class="navbar-text" data-toggle="tooltip" data-placement="bottom" title="{{ \Carbon\Carbon::createFromTimestamp(strtotime(Auth::user()->last_money_collect_time))->addDay(1)->diff(new DateTime())->format('%h hr(s) %i min(s) %s sec(s)') }}"><i class="fa fa-money"></i> {{ Auth::user()->money }}</li>

							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
									<i class="fa f-btn fa-user"></i>{{ Auth::user()->name }} <span class="caret"></span>
								</a>

								<ul class="dropdown-menu" role="menu">
									<li><a href="{{ url('/games/new') }}"><i class="fa f-btn fa-plus"></i>Add Server</a></li>
									<li><a href="{{ url('/character') }}"><i class="fa f-btn fa-user"></i>Character</a></li>
									<li><a href="{{ url('/settings') }}"><i class="fa f-btn fa-wrench"></i>Settings</a></li>
									<li><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa f-btn fa-sign-out"></i>Logout</a></li>
								</ul>

								<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
									{{ csrf_field() }}
								</form>
							</li>
						@endif
					</ul>
				</div>
			</div>
		</nav>

		@yield('content')

		<div class="footer container">
			<hr>
			<p>too lazy to make a real footer</p>
			<p><b>Copyright &copy; Nobelium (formerly "RBLXDev") {{ \Carbon\Carbon::now()->year }}</b>. Divine logo by grate god Lightning Pace (who has changed their Twitter name). Still not affiliated with ROBLOX.</p>
		</div>

		@yield('footer')

		<script>
			$(function () {
				$('[data-toggle="tooltip"]').tooltip()
			});
		</script>

		@yield('js')
	</body>
</html>
