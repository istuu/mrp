@extends('layouts.master')

@php($action = request()->segment(2) == 'create' ? 'Tambah Data':'Edit Data')
@section('title', $action.' '.$title)

@section('leftbar')
	@include('includes.superadmin.leftbar')
@endsection

@section('content')
	<!-- page title -->
	<header id="page-header">
		<h1>{{ $action.' '.$title }}</h1>
	</header>
	<!-- /page title -->

	<div id="content" class="padding-20">
		<div class="row">
			<div class="col-md-12">
					<!-- data pegawainya -->
				<div class="panel panel-default">
					<div class="panel-heading panel-heading-transparent">
						<strong>{{ $action.' '.$title }}</strong>
					</div>

					<div class="panel-body">
						<div class="col-md-{{ request()->segment(1) == 'email_templates' ? '8':'6' }}" >
							{!! form($form) !!}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('includes-scripts')
<script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>

<script>
	$(function () {
		CKEDITOR.replace( 'description' );
	});
</script>
@endsection
