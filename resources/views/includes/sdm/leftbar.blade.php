<nav id="sideNav">
	<h3>Monitoring</h3>
	<ul class="nav nav-list">
		<li><!-- dashboard -->
			<a class="dashboard" href="{{ url('dashboard') }}"><!-- warning - url used by default by ajax (if eneabled) -->
				<i class="main-icon fa fa-dashboard"></i> <span>Monitoring & Evaluasi</span>
			</a>
		</li>
		<li>
			<a href="{{ url('mrp') }}">
				<i class="main-icon fa fa-table"></i> <span>Tabel MRP</span>
			</a>
		</li>
		<li>
			<a href="{{ url('sk') }}">
				<i class="main-icon fa fa-book"></i> <span>Daftar SK</span>
			</a>
		</li>
	</ul>

	<h3>Form Mutasi</h3>
	<ul class="nav nav-list">
		<li>
			<a href="{{ url('mutasi') }}/pengajuan?tipe=1">
				<i class="main-icon fa fa-plus-circle"></i> <span>Request</span>
			</a>
		</li>
		<li>
			<a href="{{ url('mutasi') }}/pengajuan?tipe=2">
				<i class="main-icon fa fa-user-plus"></i> <span>Propose</span>
			</a>
		</li>
		<li>
			<a href="{{ url('mutasi') }}/pengajuan?tipe=3">
				<i class="main-icon fa fa-book"></i> <span>Vacancies</span>
			</a>
		</li>
	</ul>

	<h3>Status Proses Mutasi</h3>
	<ul class="nav nav-list">
		<li>
			<a href="#">
				<i class="fa fa-menu-arrow pull-right"></i>
				<i class="main-icon fa fa-arrow-circle-right"></i> <span>Mutasi Diajukan</span>
			</a>
			<ul>
				<li><a href="{{ url('status') }}/?act=minta"><span>Permintaan Pegawai</span></a></li>
				<li><a href="{{ url('status') }}/?act=req"><span>Pengajuan Pegawai</span></a></li>
				<li><a href="{{ url('status') }}/?act=reqjab"><span>Pengajuan Jabatan</span></a></li>
			</ul>
		</li>

		<li>
			<a href="#">
				<i class="fa fa-menu-arrow pull-right"></i>
				<i class="main-icon fa fa-arrow-circle-left"></i> <span>Mutasi Diterima</span>
			</a>
			<ul>
				<li><a href="{{ url('status') }}/?act=resminta"><span>Pegawai Diminta</span></a></li>
				<li><a href="{{ url('status') }}/?act=resjab"><span>Jabatan Diproyeksikan</span></a></li>
			</ul>
		</li>
	</ul><!-- MAIN MENU -->

	<h3>Evaluasi</h3>
	<nav id="sideNav"><!-- MAIN MENU -->
		<ul class="nav nav-list">
			<li><!-- dashboard -->
				<a class="dashboard" href="{{ url('dashboard') }}"><!-- warning - url used by default by ajax (if eneabled) -->
					<i class="main-icon fa fa-book"></i> <span>Daftar Evaluasi</span>
				</a>
			</li>

		</ul>
	</nav>
