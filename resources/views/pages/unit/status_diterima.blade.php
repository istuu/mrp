@extends('layouts.master')

@section('title', 'Progress Mutasi')

@section('leftbar')
	@include('includes.unit.leftbar')
@endsection

@section('includes-styles')
	@parent

	<link href="{{ asset('assets') }}/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
@endsection

@section('content')
	<div id="content" class="dashboard padding-20">
		<div id="panel-1" class="panel panel-default">
			<div class="panel-heading">
				<span class="title elipsis">
					<strong>Status Mutasi - Permintaan Mutasi dari Unit Lain</strong>
				</span>

				<!-- right options -->
				<ul class="options pull-right list-inline">
					<li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
					<li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen" data-placement="bottom"><i class="fa fa-expand"></i></a></li>
				</ul>
				<!-- /right options -->

			</div>

			<!-- panel content -->
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped table-hover dataTable js-exportable" id="statusTable">
	                    <thead>
	                        <tr>
	                            <th>Registry Number</th>
	                            <th>NIP</th>
	                            <th>Nama</th>
	                            <th>Posisi & Unit Asal</th>
	                            <th>Posisi & Unit Tujuan</th>
	                            <th>Status</th>
	                            <th>Detail & Dokumen Mutasi</th>
	                            <th> Tindak Lanjut</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                    	@foreach ($mrp as $mrps)
							<tr>
								<td>{{$mrps->registry_number}}</td>
								<td>{{$mrps->pegawai->nip}}</td>
								<td>{{$mrps->pegawai->nama_pegawai}}</td>
								<td>
									<strong>{{$mrps->formasi_jabatan_asal->formasi}} {{$mrps->formasi_jabatan_asal->jabatan}}</strong>
									<br>{{$mrps->formasi_jabatan_asal->posisi}}<br>
									<small>{{$mrps->formasi_jabatan_asal->personnel_area->username}}</small>
								</td>
								<td>
									@if ($mrps->formasi_jabatan_tujuan)
										<strong>{{$mrps->formasi_jabatan_tujuan->formasi}} {{$mrps->formasi_jabatan_tujuan->jabatan}}</strong>
										<br>{{$mrps->formasi_jabatan_tujuan->posisi}}
										<br><small>{{$mrps->formasi_jabatan_tujuan->personnel_area->username}}</small>
									@else
										Tidak ada proyeksi
									@endif
								</td>
								<td>
									@if($mrps->status == 1)
										<span class="label label-primary">Perlu Tindak Lanjut</span>
									@elseif(in_array($mrps->status, [2,3,4]))
										<span class="label label-warning">Proses Evaluasi (Pusat)</span>
									@elseif($mrps->status == 5)
										<span class="label label-success">SK Tercetak</span>
									@elseif($mrps->status == 6)
										<span class="label label-success">SK Pending</span>
									@elseif($mrps->status == 7)
    									<span class="label label-success">Lewat Masa Aktifasi (unconfirmed)</span>
									@elseif($mrps->status == 8)
    									<span class="label label-success">Clear</span>
									@elseif(in_array($mrps->status, [97,98,99]))
										<span class="label label-danger">Ditolak</span>
									@else
										<span class="label label-danger">???</span>
									@endif
								</td>
								<td>
									<a href="/status/detail/{{ $mrps->registry_number }}" class="btn btn-primary" target="_blank"><i class="fa fa-list"> Detail</i></a>
								</td>
								@if($mrps->status == 1)
		                            <td class="text-center">
		                            	<button type="button" class="btn btn-success btn-md btnApprove" data-toggle="modal" data-target="#approveModal" value="{{$mrps->registry_number}}"><i class="fa fa-check"></i> Approve</button>
			                            <form action="/status/decline/{{$mrps->registry_number}}" method="POST">
		                            		{{ csrf_field() }}
											<button type="submit" class="btn btn-danger btn-md btnDecline"><i class="fa fa-close"></i> Decline</button>
		                            	</form>
		                            </td>
								@else
									<td class="text-center"><span class="label label-success label-md">Sudah Ditindak Lanjuti</span></td>
								@endif
							</tr>

							@endforeach
	                    </tbody>
	                </table>
				</div>
			</div>
			<!-- /panel content -->
		</div>
	</div>

    <div id="approveModal" class="modal right fade" tabindex="-1" role="dialog" aria-labelledby="approveModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">

				<!-- Modal Header -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="approveModalLabel">Approve</h4>
				</div>

				<!-- Modal Body -->
				<form action="/status/approve" method="POST" enctype="multipart/form-data">
					{{ csrf_field() }}
					<input class="mrp_id" type="hidden" id="reg_num" name="reg_num" value="">
					<div class="modal-body">

						<div class="form-group">
							<h4>Surat Lolos Butuh</h4>
							<input class="custom-file-upload" type="file" id="file" name="dokumen_unit_jawab" id="contact:attachment" data-btn-text="Select a File" />
							<small class="text-muted block">Max file size: 10Mb (pdf)</small>
						</div>

						<div class="form-group">
							<h4>No. Dokumen</h4>
							<input type="text" class="form-control" name="no_dokumen_unit_jawab">
						</div>
					</div>

					<!-- Modal Footer -->
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
						<button type="submit" class="btn btn-primary">Simpan</button>
					</div>
				</form>
			</div>
		</div>
    </div>
@endsection


@section('includes-scripts')
	@parent
	<script>
        $(function(){
            $('#statusTable').DataTable({
            	"order": [[ 7, "asc" ]]
            });
        });
    </script>

    <script>
    	$(".btnApprove").click(function(){
    		$("#reg_num").val($(this).val());
    	});

    	$(".btnDecline").click(function(e){
    		if(!confirm('Apakah anda yakin akan menolak permintaan mutasi ini?'))
    			e.preventDefault();
    	});
    </script>

	<script src="{{ asset('assets') }}/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="{{ asset('assets') }}/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
@endsection
