@extends('layouts.master')

@section('title', 'Request')

@section('leftbar')
	@if(auth()->user()->user_role <> 0)
		@include('includes.unit.leftbar')
	@else
		@include('includes.superadmin.leftbar')
	@endif
@endsection

@section('content')
	<!-- page title -->
	<header id="page-header">
		<h1>Form Request</h1>
		<button class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#helpModal"><i class="fa fa-question-circle"></i> Petunjuk Pengisian</button>
	</header>
	<!-- /page title -->

	<div id="content" class="padding-20">
		@include('includes.validation_errors')

		<div class="row">

			<div class="col-md-6">
				<form class="" action="/mutasi/pengajuan/submit_form" method="post" enctype="multipart/form-data" autocomplete="on">
					<div id="content" >

					{{ csrf_field() }}
					<input type="hidden" name="mrp[tipe]" value="{{ request('tipe') }}">
					<input type="hidden" id="kode_olah_pegawai" value="">
					<!-- data pegawainya -->
					<div class="panel panel-default">
						<div class="panel-heading panel-heading-transparent">
							<strong>DATA PEGAWAI</strong>
						</div>

						<div class="panel-body">
							<fieldset>

								<div class="row">
									<div class="form-group">
										<div class="col-md-6 col-sm-6">
											<label>NIP *</label>
											<input type="text" name="nip" style="text-transform: uppercase" id="nip" value="{{ old('nip') }}" class="form-control required" autocomplete="off" required>
										</div>
										<div class="col-md-6 col-sm-6">
											<label>Nama Pegawai</label>
											<input type="text" name="dis_nama" id="nama_pegawai" value="{{ old('dis_nama') }}" class="form-control" disabled>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="form-group">
										<div class="col-md-12 col-sm-12">
											<label>Personnel Area</label>
											<input type="text" name="dis_pa" id="personnel_area" value="{{ old('dis_pa') }}" class="form-control" disabled>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="form-group">
										<div class="col-md-12 col-sm-12">
											<label>Formasi Jabatan</label>
											<textarea type="text" name="dis_fj" rows="2" id="formasi_jabatan" class="form-control" disabled>{{ old('dis_fj') }}</textarea>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="form-group">
						                <div class="col-md-12 col-sm-12">
						                    <label>Pada</label>
											<textarea type="text" name="dis_pada" id="posisi" value="" class="form-control" disabled>{{ old('dis_pada') }}</textarea>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="form-group">
										<div class="col-md-6 col-sm-6">
											<label>Masa Kerja <small class="text-muted">(di Jabatan Terakhir)</small></label>
											<input type="text" name="dis_mk" id="masa_kerja" value="{{ old('dis_mk') }}" class="form-control" disabled>
										</div>
										<div class="col-md-6 col-sm-6">
											<label>Sisa Masa Kerja</label>
											<input type="text" name="dis_sisa" id="sisa_kerja" value="{{ old('dis_sisa') }}" class="form-control" disabled>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="form-group">
										<div class="col-md-6 col-sm-6">
											<label>Lama Menjabat <small class="text-muted">(di Jabatan Terakhir)</small></label>
											<input type="text" id="lama_menjabat" value="" class="form-control" disabled>
										</div>
										<div class="col-md-6 col-sm-6">
											<label>Kali jenjang</label>
											<input type="text" id="kali_jenjang" value="" class="form-control" disabled>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="form-group">
										<div class="col-md-6 col-sm-6">
											<label>Diklat Penjenjang</label>
											<input type="text" id="diklat_penjenjang" value="" class="form-control" disabled>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-12 col-sm-12">
										<label class="switch switch">
											<input type="checkbox" name="rekom_checkbox" id="rekom_checkbox" value="0" autocomplete="off">
											<span class="switch-label" data-on="YES" data-off="NO"></span>
											<span> Rekomendasikan proyeksi jabatan? <small> - opsional</small></span>
										</label>
									</div>
								</div>

								<div id="rekom_proyeksi">

									<div class="row">
										<div class="form-group">
											<div class="col-md-12 col-sm-12">
												<label>Jenjang</label>
												<select class="form-control" id="jenjang_id" required>
													<option value="">---Pilih Jenjang---</option>
													@foreach($jenjangs as $jenjang)
														<option value="{{$jenjang->jenjang_sub}}"> {{$jenjang->jenjang_sub }} </option>
													@endforeach
												</select>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="form-group">
											<div class="col-md-12 col-sm-12">
												<label>Unit</label>
												@if(auth()->user()->user_role !== '0')
													<input type="text" class="form-control"  id="unit_id" class="form-control pointer required" required value="{{$personnelarea->personnel_area}}" disabled>
												@else
													<select class="form-control select2" id="unit_id" required>
														<option value="">---Pilih Unit---</option>
														@foreach($personnelarea as $p)
															<option value="{{$p->id}}"> {{$p->personnel_area }} </option>
														@endforeach
													</select>
												@endif
											</div>
										</div>
									</div>

									<div class="row">
										<div class="form-group">
											<div class="col-md-12 col-sm-12" >
												<select class="form-control" id="rekom_formasi" disabled>
													<option value="">---Pilih Formasi---</option>
													@foreach($formasis as $formasi)
														<option value="{{$formasi->formasi}}"> {{$formasi->formasi }} </option>
													@endforeach
												</select>
											</div>

											{{--<div class="col-md-6 col-sm-6">
												<select class="form-control" name="kode_olah" id="rekom_jabatan" disabled>
													<option>--- Jabatan ---</option>
												</select>
											</div>--}}
										</div>
									</div>
								</div>

							</fieldset>
						</div>
					</div>
				</div>

				<div id="content">
					<div class="panel panel-default">
							<div class="panel-heading panel-heading-transparent">
								<strong>DATA PENGUSUL MUTASI</strong>
							</div>

							<fieldset>
								<!-- required [php action request] -->
								<div class="panel-body">
									<div class="row">
										<div class="form-group">
											<div class="col-md-6 col-sm-6">
												<label>NIP Pengusul*</label>
												<input type="text"  style="text-transform: uppercase" name="mrp[nip_pengusul]" id="nip_pengusul" value="{{ old('mrp.nip_pengusul') }}" class="form-control required" autocomplete="off" required>
											</div>
											<div class="col-md-6 col-sm-6">
												<label>Nama Pengusul</label>
												<input type="text" name="dis_pengusul" id="nama_pengusul" value="{{ old('dis_pengusul') }}" class="form-control" disabled>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="form-group">
											<div class="col-md-12 col-sm-12">
												<label>Alasan Memutasi *</label>
												<textarea rows="3" name="mrp[alasan_mutasi]" class="form-control" placeholder="" required>{{ old('mrp.alasan_mutasi') }}</textarea>
											</div>
										</div>
									</div>
								</div>
							</fieldset>
					</div>
				</div>


				<div id="content" >
					<div class="panel panel-default">
						<div class="panel-heading panel-heading-transparent">
							<strong>DATA MUTASI</strong>
						</div>

						<fieldset>
							<div class="panel-body">
								<div class="row">
									<div class="form-group">
										<div class="col-md-6 col-sm-6">
											<label>Jenis Mutasi *</label>
											<select name="mrp[jenis_mutasi]" class="form-control required" id="jenismutasi" required >
												<option>--- Pilih ---</option>
												<option value="Dinas" {{ old('mrp.jenis_mutasi') == 'Dinas' ? 'selected="selected"' : "" }}>Dinas</option>
												<option value="Non-Dinas" {{ old('mrp.jenis_mutasi') == 'Non-Dinas' ? 'selected="selected"' : "" }}>Non Dinas</option>
											</select>
										</div>

										<div class="col-md-6 col-sm-6">
											<label>Tipe *</label>
											<select name="mrp[mutasi]" class="form-control required" value="{{ old('mrp.mutasi') }}" id="tipemutasi" required disabled>
												<option>--- Pilih ---</option>
												<!-- <option >Rotasi</option>
												<option value="Promosi" {{ old('mrp.mutasi') == 'Promosi' ? 'selected="selected"' : "" }}>Promosi</option>
												<option value="Demosi" {{ old('mrp.mutasi') == 'Demosi' ? 'selected="selected"' : "" }}>Demosi</option> -->
											</select>
										</div>

									</div>
								</div>

								<div class="row">
									<div class="form-group">
										<div class="col-md-12 col-sm-12">
											<label>
												Perkiraan Tanggal Aktivasi*
											</label>
											<!-- date picker -->
											<input type="text" class="form-control datepicker" name="mrp[requested_tgl_aktivasi]" data-format="yyyy-mm-dd" data-lang="en" data-RTL="false">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="form-group">
										<div class="col-md-12 col-sm-12">
											<label>No. Dokumen Mutasi *</label>
											<input type="text" name="mrp[no_dokumen_unit_usul]" value="{{ old('mrp.no_dokumen_unit_usul') }}" class="form-control required" required>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="form-group">
										<div class="col-md-12 col-sm-12">
											<label>Tanggal Dokumen Mutasi *</label>
											<input type="text" name="mrp[tgl_dokumen_unit_usul]" class="form-control datepicker" data-format="yyyy-mm-dd" data-lang="en" data-RTL="false" value="{{ old('mrp.tgl_dokumen_unit_usul') }}" required>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="form-group">
										<div class="col-md-12">

											<div class="form-group">
												<label>Lampiran Dokumen
													<small class="text-muted">Nota Dinas - *</small>
												</label>
												<input class="custom-file-upload" type="file" id="file" name="file_dokumen_mutasi" id="contact:attachment" data-btn-text="Select a File" />
												<small class="text-muted block">Max file size: 10Mb (pdf)</small>
											</div>
										</div>
									</div>
								</div>


							</div>
						</fieldset>
					</div>
				</div>
				<div id="content">
						<div class="panel panel-default">
							<div class="row">
								<div class="col-md-12">
									<button type="submit" class="btn btn-3d btn-teal btn-xlg btn-block margin-top-30">
											KIRIM
									</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="row">
							<div class="col-md-12">
								<!-- Bar Chart -->
								<div id="panel-graphs-flot-1" class="panel panel-default">

									<div class="panel-heading">

										<span class="elipsis"><!-- panel title -->
											<strong>Pagu Unit</strong>
										</span>

										<!-- right options -->
										<ul class="options pull-right list-inline">
											<li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
											<li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen" data-placement="bottom"><i class="fa fa-expand"></i></a></li>
											<li><a href="#" class="opt panel_close" data-confirm-title="Confirm" data-confirm-message="Are you sure you want to remove this panel?" data-toggle="tooltip" title="Close" data-placement="bottom"><i class="fa fa-times"></i></a></li>
										</ul>
										<!-- /right options -->
									</div>

									<!-- panel content -->
									<div class="panel-body nopadding">
										<canvas id="pagu_unit"></canvas>
									</div>
									<!-- /panel content -->

								</div>
								<!-- /Bar Chart -->
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<!-- Bar Chart Horizontal -->
								<div id="panel-graphs-flot-1" class="panel panel-default">

									<div class="panel-heading">

										<span class="elipsis"><!-- panel title -->
											<strong>Pagu Struktural</strong>
										</span>

										<!-- right options -->
										<ul class="options pull-right list-inline">
											<li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
											<li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen" data-placement="bottom"><i class="fa fa-expand"></i></a></li>
											<li><a href="#" class="opt panel_close" data-confirm-title="Confirm" data-confirm-message="Are you sure you want to remove this panel?" data-toggle="tooltip" title="Close" data-placement="bottom"><i class="fa fa-times"></i></a></li>
										</ul>
										<!-- /right options -->

									</div>

									<!-- panel content -->
									<div class="panel-body nopadding">

										<canvas id="struktural_chart"></canvas>

									</div>
									<!-- /panel content -->

								</div>
								<!-- /Bar Chart Horizontal -->
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<!-- Pie Chart -->
								<div id="panel-graphs-flot-1" class="panel panel-default">

									<div class="panel-heading">

										<span class="elipsis"><!-- panel title -->
											<strong>Pagu Fungsional</strong>
										</span>

										<!-- right options -->
										<ul class="options pull-right list-inline">
											<li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
											<li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen" data-placement="bottom"><i class="fa fa-expand"></i></a></li>
											<li><a href="#" class="opt panel_close" data-confirm-title="Confirm" data-confirm-message="Are you sure you want to remove this panel?" data-toggle="tooltip" title="Close" data-placement="bottom"><i class="fa fa-times"></i></a></li>
										</ul>
										<!-- /right options -->


									</div>

									<!-- panel content -->
									<div class="panel-body nopadding">
										<canvas id="fungsional_chart"></canvas>
									</div>
									<!-- /panel content -->

								</div>
								<!-- /Pie Chart -->
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<!-- TABEL -->
								<div id="panel-graphs-flot-1" class="panel panel-default">
									<div class="panel-heading">
										<span class="elipsis"><!-- panel title -->
											<strong>Tabel Formasi Jabatan Kosong</strong>
										</span>
										<!-- right options -->
										<ul class="options pull-right list-inline">
											<li><a href="#" class="opt panel_colapse" data-toggle="tooltip" title="Colapse" data-placement="bottom"></a></li>
											<li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="Fullscreen" data-placement="bottom"><i class="fa fa-expand"></i></a></li>
											<li><a href="#" class="opt panel_close" data-confirm-title="Confirm" data-confirm-message="Are you sure you want to remove this panel?" data-toggle="tooltip" title="Close" data-placement="bottom"><i class="fa fa-times"></i></a></li>
										</ul>
										<!-- /right options -->
									</div>
									<!-- panel content -->
									<div class="panel-body padding-3">
										<div class="table-responsive">
											<table class="table table-bordered nomargin dataTables" id="fj_kosong_table">
												<thead>
													<tr>
														<th>Formasi</th>
														<th>Jabatan</th>
														<th>Kosong</th>
													</tr>
												</thead>
												<tbody>
												</tbody>
											</table>
										</div>
									</div>
									<!-- /panel content -->
								</div>
								<!-- /TABEL -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="helpModalLabel" aria-hidden="true" id="helpModal">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">

				<!-- header modal -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="helpModalLabel">Petunjuk Pengisian</h4>
				</div>

				<!-- body modal -->
				<div class="modal-body">
					<ol>
						<li>Isi kolom bertanda * (maka kolom lain akan otomatis terisi)</li>
						<li>Anda hanya bisa mengusulkan mutasi untuk pegawai di unit anda</li>
						<li>Dokumen yang dilampirkan berupa Nota Dinas, dan dokumen lain yang diperlukan, dijadikan satu file dengan format .pdf</li>
					</ol>
				</div>

			</div>
		</div>
	</div>

@endsection

@section('includes-scripts')
	@parent

	<script>
		$(function(){
			window.table_fj = $('#fj_kosong_table').DataTable({
	    		"columns": [
	                { "data": "formasi" },
	                { "data": "jabatan" },
	                { "data": "kosong" }
	            ],
	        });
	    });
	</script>

	<script src="/bower_components/chart.js/dist/Chart.min.js"></script>
	<script src="{{ asset('assets') }}/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="{{ asset('assets') }}/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>

	@if(auth()->user()->user_role !== '0')
		<script>

		</script>
	@else
		<script>
			$("#unit_id").change(function(){
				var personnel_area_id = $(this).val();
				var jenjang_id = $("#jenjang_id").val();

				$.ajax({
					'url': '/mutasi/pengajuan/getFormasiJabs',
					'type': 'GET',
					'data': {
						'personnel_area_id': personnel_area_id,
						'jenjang_id' : jenjang_id
					},
					success: function(data){
						$("#rekom_formasi").html(data);
					}
				});
			})

			$("#jenjang_id").change(function(){
				var jenjang_id = $(this).val();
				var personnel_area_id = $("#unit_id").val();

				$.ajax({
					'url': '/mutasi/pengajuan/getFormasiJabs',
					'type': 'GET',
					'data': {
						'personnel_area_id': personnel_area_id,
						'jenjang_id' : jenjang_id
					},
					success: function(data){
						$("#rekom_formasi").html(data);
					}
				});
			})
		</script>
	@endif

	<script>
		$(".rating_number").keyup(function(){
			var masukan = $(this).val();

			if(masukan != "")
			{
				var angka = Math.ceil(masukan / 20);
				$($(this).attr('target')).removeClass().addClass('rating rating-'+angka+' size-13 width-100');
			}
			else
			{
				$($(this).attr('target')).removeClass().addClass('rating rating-0 size-13 width-100');
			}
		});
	</script>

	<script>
		$("#rekom_checkbox").click(function(e){
			if(!$("#kode_olah_pegawai").val())
			{
				alert('NIP tidak ditemukan, pastikan informasi pegawai telah muncul');
				e.preventDefault();
				return;
			}

			var on_off = $(this).val();
			$(this).val( on_off == '0' ? '1' : '0');
			$('#rekom_formasi').prop('disabled', function(i, v) { return !v; });
			$('#rekom_formasi').prop('required', function(i, v) { return !v; });
			$('#rekom_jabatan').prop('required', function(i, v) { return !v; });

			if($(this).val() == '0')
			{
				$('#rekom_jabatan').attr('disabled', 'true');
				$('#rekom_formasi').attr('disabled', 'true');
			}
		});
	</script>

	<script>
		$("#nip_pengusul").on('keyup paste', function(){
			var nip = $(this).val();
			if(nip.length >= 6)
			{
				$.ajax({
					'url': '/mutasi/pengajuan/get_pegawai_info',
					'type': 'GET',
					'data': {
						'nip': nip
					},
					'dataType': 'json',
					error: function(){

					},
					success: function(data){
						if(data)
						{
							$("#nama_pengusul").val(data.nama_pegawai);
						}
					}
				});

			}
			else
			{
				$("#nama_pengusul").val('');
			}
		});

		$("#nip").keyup(function(){
			var nip = $(this).val();

			if(nip.length >= 6)
			{
				$.ajax({
					'url': '/mutasi/pengajuan/get_pegawai_info',
					'type': 'GET',
					'data': {
						'nip': nip,
						'option': true
					},
					'dataType': 'json',
					error: function(data){

					},
					success: function(data){
						if(!!data)
						{
							$("#nama_pegawai").val(data.nama_pegawai);
							$("#personnel_area").val(data.personnel_area);
							$("#formasi_jabatan").val(data.nama_panjang_posisi);
							$("#posisi").val(data.pada_posisi);
							$("#masa_kerja").val(data.masa_kerja);
							$("#sisa_kerja").val(data.sisa_masa_kerja);
							$("#lama_menjabat").val(data.lama_menjabat);
							$("#kali_jenjang").val(data.kali_jenjang);
							$("#kode_olah_pegawai").val(data.kode_olah_forja);
							$("#diklat_penjenjang").val(data.diklat);
						}
						else
						{
							$("#nama_pegawai").val('');
							$("#personnel_area").val('');
							$("#formasi_jabatan").val('');
							$("#posisi").val('');
							$("#masa_kerja").val('');
							$("#sisa_kerja").val('');
							$("#lama_menjabat").val('');
							$("#kali_jenjang").val('');
							$("#kode_olah_pegawai").val('');
							$("#diklat_penjenjang").val('');
						}
					}
				});
			}
			else
			{
				$("#nama_pegawai").val('');
				$("#personnel_area").val('');
				$("#formasi_jabatan").val('');
				$("#posisi").val('');
				$("#masa_kerja").val('');
				$("#sisa_kerja").val('');
				$("#lama_menjabat").val('');
				$("#kali_jenjang").val('');
				$("#kode_olah_pegawai").val('');
				$("#diklat_penjenjang").val('');
			}
		});
	</script>

	<script>
		$("#rekom_formasi").change(function(){
			var formasi = $(this).val();

			$.ajax({
				'url': '/mutasi/pengajuan/getFormasiJabs',
				'type': 'GET',
				'data': {
					'formasi': formasi,
					'kode_olah': $("#kode_olah_pegawai").val(),
				},
				'dataType': 'json',
				error: function(){

				},
				success: function(data){
					var jabatan = $("#rekom_jabatan");
					jabatan.empty();
					jabatan.append('<option>--- Jabatan ---</option>');
					jabatan.removeAttr('disabled');
					$.each(data, function(key, value){
						console.log(value);
						jabatan.append('<option value="'+key+'">'+value+'</option>');
					});
				}
			});
		})
	</script>

	<script>
		// expected value parameter
		// value
		// 	|_ labels
		// 	|_ data
		// 		|_ isi
		// 		|_ akan
		// 		|_ pagu
		function drawChart(target, value = null)
		{
			var options = {
				responsive: true,
    			maintainAspectRatio: true,
				tooltips: {
			        mode: 'label',
			        callbacks: {
		                label: function(tooltipItem, data) {
		                	var datasetIndex = tooltipItem['datasetIndex'];
		                	if(datasetIndex == 1)
		                	{
		                		//akan terisi (human readable) = akan terisi - realisasi
		                		return data['datasets'][datasetIndex]['label']+': '+(data['datasets'][1]['data'][tooltipItem['index']] - data['datasets'][0]['data'][tooltipItem['index']]);
		                	}
		                  	return data['datasets'][datasetIndex]['label']+': '+data['datasets'][datasetIndex]['data'][tooltipItem['index']];
		                }
		            },
			    },
			    hover: {
					mode: true
				},
				scales: {
					yAxes: [{
						stacked: false,
						ticks: {
							beginAtZero: true
						}
					}],
					xAxes: [{
						stacked: true,
					}]
				}
			};

		    console.log(value.data);
			var data = {
			    labels: value.labels,
			    datasets: [
			        {
			            label: "Realisasi",
			            // backgroundColor: 'rgba(255, 99, 132, 0.2)',
			            borderWidth: 1,
			            data: value.data.isi,
			            backgroundColor: '#4b77a3'
			        },
			        {
			            label: "Akan Terisi",
			            // backgroundColor: 'rgba255(, 206, 86, 0.2)',
			            borderWidth: 1,
			            data: value.data.akan,
			            backgroundColor: '#a4a6a8'
			        },
			        {
			            label: "Pagu",
			            // backgroundColor: 'rgba255(, 206, 86, 0.2)',
			            borderWidth: 1,
			            data: value.data.pagu,
			            backgroundColor: '#9db6e0'
			        }
			    ]
			};

			var ctx = document.getElementById(target).getContext("2d");
			// ctx.height = 400;
			var newChart = new Chart(ctx, {
			    type: 'bar',
			    data: data,
			    options: options
			});
			var obj = {};
			obj.name = target;
			obj.chart_obj = newChart;
			chart.push(obj);
		};
	</script>

	<script>
		$(document).ready(function() {
			window.chart = [];
			callAjaxUnitChart();
			callAjaxChart();
		});
	</script>

	<script>
		function callAjaxChart(){
			$.ajax({
				'url': '/monitoring/ajax/getRealisasiPagu',
				'type': 'GET',
				'data': {
					'unit': '{{ auth()->user()->username }}',
					'level': 'all',
					'is_unit': true
				},
				'dataType': 'json',
				error: function(data){

				},
				success: function(data){
					var value = {labels: [], data:{isi: [], akan:[], pagu:[]}};

					$.each(data.struktural, function(key_jen, val_jen){ //key = jenjang
						$.each(val_jen, function(key_lvl, val_lvl){ //key = level
							value.labels.push(key_jen+'_'+key_lvl);
							value.data.isi.push(val_lvl.isi);
							value.data.akan.push(val_lvl.akan);
							value.data.pagu.push(val_lvl.pagu);
						});
					});
					drawChart("struktural_chart", value);

					var value = [];

					$.each(data.fungsional, function(key_unit, val_unit){ //key = unit
						// console.log(val_unit.length);
						if(val_unit.length != 0)
						{
							var obj = {unit: '', chart_data: {labels: [], data:{isi: [], akan:[], pagu:[]}}}
							obj.unit = key_unit;
							$.each(val_unit, function(key_lvl, val_lvl){ //key = lvl
								obj.chart_data.labels.push(key_lvl);
								obj.chart_data.data.isi.push(val_lvl.isi);
								obj.chart_data.data.akan.push(val_lvl.akan);
								obj.chart_data.data.pagu.push(val_lvl.pagu);
							});
							value.push(obj);
						}
					});

					$.each(value, function(key, val){
						// $("#fungsio_container").append('<h4 class="unit_name">'+val.unit+'</h4>');
						// $("#fungsio_container").append('<canvas id="'+val.unit+'"></canvas>');
						// console.log(val);
						drawChart('fungsional_chart', val.chart_data);
					});

					table_fj.clear();
					table_fj.rows.add(data.table);
					table_fj.draw();
				}
			});
		};
	</script>

	<script>
		function callAjaxUnitChart(){
			$.ajax({
				'url': '/monitoring/ajax/getRealisasiPaguUnit',
				'type': 'GET',
				'data': {

				},
				'dataType': 'json',
				error: function(data){

				},
				success: function(data){
					var value = {labels: [], data:{isi: [], akan:[], pagu:[]}};

					$.each(data, function(key_jen, val_jen){ //key = jenjang
						value.labels.push(key_jen);
						value.data.isi.push(val_jen.isi);
						value.data.akan.push(val_jen.akan);
						value.data.pagu.push(val_jen.pagu);
					});
					drawChart("pagu_unit", value);
				}
			});
		};
	</script>
	<script>
		$("#jenismutasi").change(function(){
			var jenismutasi = $(this).val();
			if(jenismutasi == "Dinas"){
				var tipemutasi = $("#tipemutasi")
				tipemutasi.empty();
				tipemutasi.append('<option>--- Tipe Mutasi ---</option>');
				tipemutasi.removeAttr('disabled');
				tipemutasi.append('<option>Rotasi</option>');
				tipemutasi.append('<option>Promosi</option>');
				tipemutasi.append('<option>Demosi</option>');
				tipemutasi.append('<option>TK Diperbantukan</option>');
				tipemutasi.append('<option>Tugas Belajar</option>');
				tipemutasi.append('<option>Aktif dari Tugas Belajar</option>');
			}
			else if(jenismutasi == "Non-Dinas"){
				var tipemutasi = $("#tipemutasi")
				tipemutasi.empty();
				tipemutasi.append('<option>--- Tipe Mutasi ---</option>');
				tipemutasi.removeAttr('disabled');
				tipemutasi.append('<option>Aktif dari IDT</option>');
				tipemutasi.append('<option>Ct diluar Tanggungan</option>');
				tipemutasi.append('<option>APS</option>');
			}
		});
	</script>
@endsection
