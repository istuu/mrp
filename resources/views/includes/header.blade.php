@php
	$user = auth()->user();
	$notif_count = $user->unreadNotifications->count();
@endphp

<header id="header">
	<!-- Mobile Button -->
	<button id="mobileMenuBtn"></button>

	<!-- Logo -->
	<span class="logo pull-left">
		<a href="{{ url('dashboard') }}"><img src="{{ asset('assets') }}/images/logo-header.png" alt="admin panel" height="35" /></a>
	</span>

	<nav>

		<!-- OPTIONS LIST -->
		<ul class="nav pull-right">
			<li class="dropdown pull-left">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
				<i class="fa fa-bell" style="margin-top: 12px; font-size: 150%; "></i>
				{!! $notif_count ? '<i class="fa fa-star size-11" id="star"></i>' : '' !!}
			</a>
			<ul class="dropdown-menu notify-drop">
            	<div class="notify-drop-title">
            		<div class="row">
            			<div class="col-md-6 col-sm-6 col-xs-6">Belum Dibaca (<b id="notif_count">{{ $notif_count }}</b>)</div>
            			@if ($notif_count)
            				<div class="col-md-6 col-sm-6 col-xs-6 text-right"><button onclick=" event.stopPropagation();" class="rIcon allRead" data-tooltip="tooltip" data-placement="bottom" title="Tandai telah dibaca semua" id="markAllRead"><i class="fa fa-check"></i></button></div>
            			@endif
            		</div>
            	</div>
	            <!-- end notify title -->
	            <!-- notify content -->
	            <div class="drop-content">
	            	@if ($notif_count)
		            	@foreach ($user->unreadNotifications as $notification)
			            	<li id="notif_{{ $notification->id }}">
			            		<div class="col-md-2 col-sm-2 col-xs-2 text-center">
			            			{{-- <div class="notify-img"><img src="http://placehold.it/45x45" alt=""></div> --}}
			            			<h3><i class="fa fa-question-circle"></i></h3>
			            		</div>
			            		<div class="col-md-8 col-sm-8 col-xs-8 pd-l0">
			            			<a href="" style="padding-left: 0">{{ $notification->data['message'] }}</a>
			            			<br>
				            		<p class="time">{{ $notification->created_at->diffForHumans() }}</p>
			            		</div>
			            		<div class="col-md-1 col-sm-1 col-xs-1">
			            			<button onclick=" event.stopPropagation();" class="markRead" title="Tandai sudah dibaca" target="{{ $notification->id }}"><i class="fa fa-dot-circle-o"></i></button>
			            		</div>
			            	</li>
		            	@endforeach
	            	@else
	            		<div class="col-md-12 col-sm-12 col-xs-12 text-center">
	            			<p>Tidak ada notifikasi baru</p>
	            		</div>
	            	@endif
	            </div>
	            <div class="notify-drop-footer text-center">
	            	<a href="{{ url('notifications') }}"><i class="fa fa-eye"></i> Lihat semua notifikasi</a>
	            </div>
	          </ul>
	        </li>


			<!-- USER OPTIONS -->
			<li class="dropdown pull-left">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<img class="user-avatar" alt="" src="{{ asset('assets') }}/images/noavatar.png" height="34" />
					<span class="user-name">
						<span class="hidden-xs">
							{{ $user->nama_pendek }} <i class="fa fa-angle-down"></i>
						</span>
					</span>
				</a>
				<ul class="dropdown-menu hold-on-click">
					@if ($user->user_role === 1)
						<li><!-- settings -->
							<a href="{{ url('profil') }}"><i class="fa fa-cogs"></i> Edit Profil</a>
						</li>

						<li class="divider"></li>
					@endif

					<li><!-- logout -->
						<a href="{{ url('logout') }}"><i class="fa fa-power-off"></i> Log Out</a>
					</li>
				</ul>
			</li>
			<!-- /USER OPTIONS -->

		</ul>
		<!-- /OPTIONS LIST -->

	</nav>

</header>
