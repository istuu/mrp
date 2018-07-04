<?php


?>
<!doctype html>
<html lang="en-US">
	<head>
		<title>Request | MRP-App</title>

		<!-- mobile settings -->
		<meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0" />

		<!-- WEB FONTS -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800&amp;subset=latin,latin-ext,cyrillic,cyrillic-ext" rel="stylesheet" type="text/css" />

		<!-- CORE CSS -->
		<link href="{{ asset('assets') }}/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

		<!-- THEME CSS -->
		<link href="{{ asset('assets') }}/css/essentials.css" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets') }}/css/layout.css" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets') }}/css/color_scheme/green.css" rel="stylesheet" type="text/css" id="color_scheme" />

	</head>

	<body>


		<!-- WRAPPER -->
		<div id="wrapper">

			<div class="padding-20">

				<div class="panel panel-default">

					<div class="panel-body text-center">
						<div class="container">
						  <div class="jumbotron">
						    <h1>Peringatan!</h1>
						    <p>Anda tidak mempunyai kewenangan untuk mengajukan proyeksi pada formasi jabatan tersebut! Untuk melanjutkan usulan silakan klik menu purpose.</p>
							<a href="{{ url('mutasi/pengajuan?tipe=2') }}" class="btn btn-lg btn-primary"> <span class="fa fa-user-plus"></span>  Purpose</a>
							<a href="{{ url('dashboard') }}" class="btn btn-lg btn-danger"> <span class="fa fa-home"></span> Beranda</a>
						  </div>
						</div>
					</div>

				</div>

			</div>
		</div>
		<!-- /WRAPPER -->




		<!-- JAVASCRIPT FILES -->
		<script type="text/javascript">var plugin_path = '{{ asset("assets") }}/plugins/';</script>
		<script type="text/javascript" src="{{ asset('assets') }}/plugins/jquery/jquery-2.2.3.min.js"></script>
		<script type="text/javascript" src="{{ asset('assets') }}/js/app.js"></script>

		<script type="text/javascript">
			// window.print();
		</script>

		@include('includes.notifications')

	</body>
</html>
