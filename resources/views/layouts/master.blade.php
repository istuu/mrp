<!doctype html>
<html lang="en-US">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title>@yield('title') | MRP App</title>

		<!-- mobile settings -->
		<meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />

		<meta name="csrf-token" content="{{ csrf_token() }}">

		<!-- WEB FONTS -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800&amp;subset=latin,latin-ext,cyrillic,cyrillic-ext" rel="stylesheet" type="text/css" />


		@section('includes-styles')
			<link href="{{ asset('assets') }}/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

			<!-- THEME CSS -->
			<link href="{{ asset('assets') }}/css/essentials.css" rel="stylesheet" type="text/css" />
			<link href="{{ asset('assets') }}/css/layout.css" rel="stylesheet" type="text/css" />
			<link href="{{ asset('assets') }}/css/notifications.css" rel="stylesheet" type="text/css" />
			<link href="{{ asset('assets') }}/css/color_scheme/green.css" rel="stylesheet" type="text/css" id="color_scheme" />
			<link href="{{ asset('assets') }}/css/sdm_dashboard.css" rel="stylesheet" type="text/css" />
			<link rel="stylesheet" href="{{ asset('css/loader.css') }}">
			<link rel="stylesheet" href="{{ asset('vendor/sweetalert/sweetalert.min.css') }}">

			@stack('styles')

			<!-- CORE CSS -->
		@show
	</head>
	<body>
		<!-- WRAPPER -->
		<div id="wrapper" class="clearfix">
			<aside id="aside">
				@yield('leftbar')

				<span id="asidebg"><!-- aside fixed background --></span>
			</aside>
			<!-- /ASIDE -->


			<!-- HEADER -->
			@include('includes.header')
			<!-- /HEADER -->


			<!--
				MIDDLE
			-->
			<section id="middle">
				@yield('content')
			</section>
			<!-- /MIDDLE -->

		</div>


			<!-- JAVASCRIPT FILES -->
			<script type="text/javascript">var plugin_path = '/assets/plugins/';</script>
			<script type="text/javascript" src="{{ asset('assets') }}/plugins/jquery/jquery-2.2.3.min.js"></script>
			<script type="text/javascript" src="{{ asset('assets') }}/js/app.js"></script>
			<script type="text/javascript" src="{{ asset('assets') }}/js/notifications.js"></script>
			<script type="text/javascript" src="{{ asset('vendor/sweetalert/sweetalert.min.js') }}"></script>

			<script>
				$(document).on({
	                ajaxStart: function() { $('body').addClass("loading");    },
	                ajaxStop: function() { $('body').removeClass("loading"); }
	            });
	        </script>
			@section('includes-scripts')
		@show
		@yield('sdm_leftbar_scripts')
		@include('includes.notifications')
		<div class="loader"><!-- Place at bottom of page --></div>
	</body>
</html>
