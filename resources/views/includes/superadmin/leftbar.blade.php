<nav id="sideNav">
	<!-- <h3>Form Mutasi</h3> -->
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

	<!-- <h3>Status Proses Mutasi</h3> -->
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
	<!-- <h3>Monitoring</h3> -->
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
	{{--<h3>Evaluasi</h3>
	<nav id="sideNav"><!-- MAIN MENU -->
		<ul class="nav nav-list">
			<li><!-- dashboard -->
				<a class="dashboard" href="{{ url('dashboard') }}"><!-- warning - url used by default by ajax (if eneabled) -->
					<i class="main-icon fa fa-book"></i> <span>Daftar Evaluasi</span>
				</a>
			</li>

		</ul>
	</nav>--}}

	<h3>Superadmin</h3>
	<ul class="nav nav-list">
		<li class="{{ checkParentActive(['pegawais']) }}">
			<a href="{{ url('pegawais') }}">
				<i class="main-icon fa fa-user"></i> <span>Data Pegawai</span>
			</a>
		</li>
		<li class="{{ checkParentActive(['legacies', 'formations', 'personnels']) }}">
			<a href="#">
				<i class="fa fa-menu-arrow pull-right"></i>
				<i class="main-icon fa fa-briefcase"></i> <span>Jabatan</span>
			</a>
			<ul>
				<li class="{{ checkChildActive('legacies') }}"><a href="{{ url('legacies') }}"><span>Legacy Codes</span></a></li>
				<li class="{{ checkChildActive('formations') }}"><a href="{{ url('formations') }}"><span>Formasi Jabatan</span></a></li>
				<li class="{{ checkChildActive('personnels') }}"><a href="{{ url('personnels') }}"><span>Personnel Area</span></a></li>
			</ul>
		</li>
		<li class="{{ checkParentActive(['key_competencies', 'daily_competencies']) }}">
			<a href="#">
				<i class="fa fa-menu-arrow pull-right"></i>
				<i class="main-icon fa fa-trophy"></i> <span>Penilaian Pegawai</span>
			</a>
			<ul>
				<li class="{{ checkChildActive('key_competencies') }}"><a href="{{ url('key_competencies') }}"><span>Kompetensi Peran</span></a></li>
				<li class="{{ checkChildActive('daily_competencies') }}"><a href="{{ url('daily_competencies') }}"><span>Kompetensi Lainnya</span></a></li>
			</ul>
		</li>
		<!-- <li class="{{ checkParentActive(['roles','personnels']) }}">
			<a href="#">
				<i class="fa fa-menu-arrow pull-right"></i>
				<i class="main-icon fa fa-users"></i> <span>Manajemen Users</span>
			</a>
			<ul>
				<li class="{{ checkChildActive('roles') }}"><a href="{{ url('roles') }}"><span>Roles</span></a></li>
			</ul>
		</li> -->
		<li class="{{ checkParentActive(['info_diklats']) }}">
			<a href="{{ url('info_diklats') }}">
				<i class="main-icon fa fa-clipboard"></i> <span>Info Diklat</span>
			</a>
		</li>
	</ul>

</nav>
