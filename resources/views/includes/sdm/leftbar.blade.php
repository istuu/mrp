<nav id="sideNav"><!-- MAIN MENU -->
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

	<h3>Superadmin</h3>
	<ul class="nav nav-list">
		<li class="{{ checkParentActive(['pegawais']) }}">
			<a href="{{ url('pegawais') }}">
				<i class="main-icon fa fa-user"></i> <span>Data Pegawai</span>
			</a>
		</li>
		<li class="{{ checkParentActive(['legacies', 'formations']) }}">
			<a href="#">
				<i class="fa fa-menu-arrow pull-right"></i>
				<i class="main-icon fa fa-briefcase"></i> <span>Jabatan</span>
			</a>
			<ul>
				<li class="{{ checkChildActive('legacies') }}"><a href="{{ url('legacies') }}"><span>Legacy Codes</span></a></li>
				<li class="{{ checkChildActive('formations') }}"><a href="{{ url('formations') }}"><span>Formasi Jabatan</span></a></li>
			</ul>
		</li>
		<li class="{{ checkParentActive(['roles','personnels']) }}">
			<a href="#">
				<i class="fa fa-menu-arrow pull-right"></i>
				<i class="main-icon fa fa-users"></i> <span>Manajemen Users</span>
			</a>
			<ul>
				<li class="{{ checkChildActive('personnels') }}"><a href="{{ url('personnels') }}"><span>Personnel Area</span></a></li>
				<li class="{{ checkChildActive('roles') }}"><a href="{{ url('roles') }}"><span>Roles</span></a></li>
			</ul>
		</li>
	</ul>

</nav>
