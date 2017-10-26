<!DOCTYPE html>
<html>
<base href="{{URL::asset('/')}}" target="_top">
<?php
include(app_path().'/common_includes/header.blade.php');
include(app_path().'/common_includes/footer.blade.php');
?>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

	<header class="main-header">
		<!-- Logo -->
		<a href="#" class="logo">
			<!-- mini logo for sidebar mini 50x50 pixels -->
			<span class="logo-mini"><b></b></span>
			<!-- logo for regular state and mobile devices -->
			<span class="logo-lg"><b>IMC</b>RBNQA</span>
		</a>
		<!-- Header Navbar: style can be found in header.less -->
		<nav class="navbar navbar-static-top" role="navigation">
			<!-- Sidebar toggle button-->
			<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
				<span class="sr-only">Toggle navigation</span>
			</a>
			<div class="navbar-custom-menu">
				<ul class="nav navbar-nav">
					<!-- Messages: style can be found in dropdown.less-->
										<!-- Notifications: style can be found in dropdown.less -->
										<!-- Tasks: style can be found in dropdown.less -->

					<!-- User Account: style can be found in dropdown.less -->
					<li class="dropdown user user-menu">
                            <span class="hidden-xs">
					@if (Auth::guest())
						<li><a href="{{ url('/login') }}">Login</a></li>
						<li><a href="{{ url('/register') }}">Register</a></li>
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
								{{ Auth::user()->name }} <span class="caret"></span>
							</a>

							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
							</ul>
						</li>
					@endif
					</li>
					<!-- Control Sidebar Toggle Button -->
					<li>
						<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
					</li>
				</ul>
			</div>
		</nav>
	</header>

</div>
<section class="content col-lg-8" style="margin:0% 10% 0 10%" >
	<div class="box box-default">
		@yield('content')
	</div>
</section>



</body>
</html>
