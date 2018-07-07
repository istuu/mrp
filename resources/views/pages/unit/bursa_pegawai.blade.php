@extends('layouts.master')

@section('title', 'Propose')

@section('leftbar')
	@if(auth()->user()->user_role == 0)
		@include('includes.superadmin.leftbar')
	@elseif(auth()->user()->user_role == 1)
		@include('includes.unit.leftbar')
	@else
		@include('includes.sdm.leftbar')
	@endif
@endsection

@section('content')
	<!-- page title -->
	<header id="page-header">
		<h1>Propose</h1>
		<button class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#helpModal"><i class="fa fa-question-circle"></i> Petunjuk Pengisian</button>
	</header>
	<!-- /page title -->



	<div id="content" class="padding-20" >
		@include('includes.validation_errors')

		<div class="row">
			<form action="/mutasi/pengajuan/submit_form" method="post" enctype="multipart/form-data" autocomplete="on">
				<div class="col-md-6">

					{{ csrf_field() }}
					<input type="hidden" name="mrp[tipe]" value="{{ request('tipe') }}">
					<input type="hidden" id="kode_olah_pegawai" value="">
					<!-- data pegawai -->
					<div class="panel panel-default">
						<div class="panel-heading panel-heading-transparent">
							<strong>DATA PEGAWAI</strong>
							<small class="pull-right">(*) wajib diisi</small>
						</div>

						<fieldset>
							<!-- required [php action request] -->
							<div class="panel-body">

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
						                    <label>Personel Area</label>
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
											<label>Masa Kerja</label>
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
												<label>Unit</label>
												<select class="form-control select2" id="unit_id" required>
													<option>---Pilih Unit---</option>
													@foreach($personnelarea as $p)
														<option value="{{$p->id}}"> {{$p->personnel_area }} </option>
													@endforeach
												</select>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="form-group">
											<div class="col-md-6 col-sm-6">
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
											<div class="col-md-6 col-sm-6">
												<label>Level</label>
												<select class="form-control" id="level" required>
													<option value="">---Pilih Level---</option>
													@foreach($levels as $level)
														<option value="{{$level->level}}"> {{$level->level }} </option>
													@endforeach
												</select>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="form-group">
											<div class="col-md-12 col-sm-12" >
												<select name="rekom_formasi" class="form-control" id="rekom_formasi" disabled>
													<option>---Pilih Formasi---</option>
													@foreach($formasis as $formasi)
														<option value="{{$formasi->id}}"> {{$formasi->formasi }} </option>
													@endforeach
												</select>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="form-group">
											<div class="col-md-12 col-sm-12">
												<label>Posisi pada Unit</label>
												<textarea id="posisi_pada_unit" class="form-control" disabled></textarea>
											</div>
										</div>
									</div>
								</div>

						</fieldset>
					</div>

					<!-- data pengusul -->
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

					<!-- data mutasi -->
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
													<small class="text-muted">Curriculum Vitae dan Nota Dinas - *</small>
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

				<div class="col-md-6">
					<div class="panel panel-default">
						<div class="panel-heading panel-heading-transparent">
							<strong>PENILAIAN PEGAWAI</strong>
						</div>
							<!-- required [php action request] -->
						<div class="panel-body">
							<p><strong>KOMPETENSI PERAN</strong></p>
							@foreach($keys as $k)
								<div class="row">
									<div class="form-group">
										<div class="col-md-5 col-sm-5">
											<label>{{ $k->title }}</label>
										</div>
										<div class="col-md-3 col-sm-3">
											<input type="number" name="key[]" min="0" max="100" class="form-control required rating_number" required target="#rating1" placeholder="0-100">
										</div>
										<div class="col-md-4 col-sm-4">
											<div class="rating rating-0 size-13 width-100" id="rating1"><!-- rating-0 ... rating-5 --></div>
										</div>
									</div>
								</div>
							@endforeach

							<hr>
							<p><strong>KOMPETENSI LAINNYA</strong></p>
							@foreach($dailys as $d)
								<div class="row">
									<div class="form-group">
										<div class="col-md-5 col-sm-5">
											<label>{{ $d->title }}</label>
										</div>
										<div class="col-md-3 col-sm-3">
											<input type="number" name="" min="0" max="100" name="daily[]" class="form-control rating_number" target="#rating9" placeholder="0-100">
										</div>
										<div class="col-md-4 col-sm-4">
											<div class="rating rating-0 size-13 width-100" id="rating9"><!-- rating-0 ... rating-5 --></div>
										</div>
									</div>
								</div>
							@endforeach

							<div class="row">
								<div class="form-group">
									<div class="col-md-5 col-sm-5">
										<input type="text" class="form-control" list="unitsi" name="nilai[bahasa_3]" id="bahasa_3" min="0" max="100" value="{{ old('nilai.bahasa_3') }}" class="form-control pointer required" placeholder="Bahasa .... (opsional)">
											<datalist id="unitsi">
												<option value="Bahasa Mandarin">
												<option value="Bahasa Jepang">
												<option value="Bahasa Jerman">
												<option value="Bahasa Arab">
												<option value="Bahasa Perancis">
											</datalist>
										<!-- <input type="text" name="nilai[bahasa_3]" id="bahasa_3" min="0" max="100" value="{{ old('nilai.bahasa_3') }}" class="form-control" placeholder="Bahasa .... (opsional)"> -->
									</div>
									<div class="col-md-3 col-sm-3">
										<input type="number" name="nilai[bahasa_3_nilai]" min="0" max="100" value="{{ old('nilai.bahasa_3_nilai') }}" class="form-control rating_number" target="#rating13" placeholder="0-100">
									</div>
									<div class="col-md-4 col-sm-4">
										<div class="rating rating-0 size-13 width-100" id="rating13"><!-- rating-0 ... rating-5 --></div>
									</div>
								</div>
							</div>

							<hr>
							<p><strong>INFORMASI LAIN</strong></p>
							<div class="row">
								<div class="form-group">
									<div class="col-md-4">
										<label>Career Willingness *</label>
									</div>
									<div class="col-md-8">
										{{--<input type="text" class="form-control" list="inre" name="nilai[career_willingness]" id="bahasa_3" min="0" max="100" value="{{ old('nilai.career_willingness') }}" class="form-control pointer" placeholder="Career Willingness">
											<datalist id="inre">
												@foreach($jenjangs as $j)

													@if($j->jenjang_txt !== 'HOLDING')
														<option value="{{ $j->jenjang_txt }}">
													@endif
												@endforeach
											</datalist>--}}
											<select name="career_willingness" class="form-control">
												<option value="">-- Pilihan --</option>
												<option value="BoD (Direktur)">BoD (Direktur)</option>
												<option value="BoD -1 (Manajemen Atas)">BoD -1 (Manajemen Atas)</option>
												<option value="BoD -2 (Manajemen Menengah)">BoD -2 (Manajemen Menengah)</option>
												<option value="BoD -3 (Manajemen Dasar)">BoD -3 (Manajemen Dasar)</option>
												<option value="BoD -4 (Supervisori Atas)">BoD -4 (Supervisori Atas)</option>
												<option value="BoD -5 (Supervisori Dasar)">BoD -5 (Supervisori Dasar)</option>
												<option value="Fgs (Fungsional)">Fgs (Fungsional)</option>
											</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<div class="col-md-4">
										<label>Readiness (Kesehatan) *</label>
									</div>
									<div class="col-md-8">
										<label class="radio">
											<input type="radio" name="nilai[kesehatan_option]" value="Kendala">
											<i></i> Kendala
										</label>
										<label class="radio">
											<input type="radio" name="nilai[kesehatan_option]" value="Tidak Kendala">
											<i></i> Tidak Kendala
										</label>
										<textarea rows="2" name="nilai[kesehatan]" value="" class="form-control required col-md-6" placeholder="Deskripsi Kesehatan" required>{{ old('nilai.kesehatan') }}</textarea>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<div class="col-md-4">
										<label>Readiness (Eksternal) *</label>
									</div>
									<div class="col-md-8">
										<label class="radio">
											<input type="radio" name="nilai[keluarga_option]" value="Kendala">
											<i></i> Kendala
										</label>
										<label class="radio">
											<input type="radio" name="nilai[keluarga_option]" value="Tidak Kendala">
											<i></i> Tidak Kendala
										</label>
										<textarea rows="2" name="nilai[external_rediness]" value="" class="form-control required col-md-6" placeholder="Deskripsi kesiapan dari sisi eksternal Pegawai, misal : kondisi keluarga, kondisi sosial, dan lainnya." required>{{ old('nilai.external_rediness') }}</textarea>
									</div>
								</div>
							</div>

							</hr>
							<p><strong>PENILAIAN PERSONAL</strong></p>
							<div class="row">
								<div class="form-group">
									<div class="col-md-4">
										<label>Hubungan dengan Rekan Kerja <small>(peer)</small> *</label>
									</div>
									<div class="col-md-8">
										<label class="radio">
											<input type="radio" name="hds" value="Sangat Bagus" {{ old('hds') == 'Sangat Bagus' ? 'selected="selected"' : '' }}>
											<i></i> Sangat Bagus
										</label>

										<label class="radio">
											<input type="radio" name="hds" value="Bermasalah" {{ old('hds') == 'Bermasalah' ? 'selected="selected"' : '' }}>
											<i></i> Bermasalah
										</label>
										<textarea rows="2" name="nilai[hubungan_sesama]" value="" class="form-control required col-md-6" placeholder="Deskripsi" required>{{ old('nilai.hubungan_sesama') }}</textarea>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="form-group">
									<div class="col-md-4">
										<label>Hubungan dengan Atasan *</label>
									</div>
									<div class="col-md-8">
										<label class="radio">
											<input type="radio" name="hda" value="Sangat Bagus" {{ old('hda') == 'Sangat Bagus' ? 'selected="selected"' : '' }}>
											<i></i> Sangat Bagus
										</label>

										<label class="radio">
											<input type="radio" name="hda" value="Bermasalah" {{ old('hda') == 'Bermasalah' ? 'selected="selected"' : '' }}>
											<i></i> Bermasalah
										</label>
										<textarea rows="2" name="nilai[hubungan_atasan]" value="" class="form-control required col-md-6" placeholder="Deskripsi" required>{{ old('nilai.hubungan_atasan') }}</textarea>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<button type="submit" class="btn btn-3d btn-teal btn-xlg btn-block margin-top-30" id="next1">
								KIRIM
							</button>
						</div>
					</div>
				</div>
			</form>
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
						<li>Dokumen yang dilampirkan berupa CV, Nota Dinas, dan dokumen lain yang diperlukan, dijadikan satu file dengan format .pdf</li>
					</ol>
				</div>

			</div>
		</div>
	</div>
@endsection

@section('includes-scripts')
	@parent
		<script>
			$("#unit_id").change(function(){
				var personnel_area_id = $(this).val();
				var level = $("#level").val();
				var jenjang_id = $("#jenjang_id").val();

				$.ajax({
					'url': '/mutasi/pengajuan/getFormasiJabs',
					'type': 'GET',
					'data': {
						'personnel_area_id': personnel_area_id,
						'jenjang_id' : jenjang_id,
						'level' : level,
					},
					success: function(data){
						$("#rekom_formasi").html(data);
					}
				});
			})

			$("#level").change(function(){
				var level = $(this).val();
				var personnel_area_id = $("#unit_id").val();
				var jenjang_id = $("#jenjang_id").val();

				$.ajax({
					'url': '/mutasi/pengajuan/getFormasiJabs',
					'type': 'GET',
					'data': {
						'personnel_area_id': personnel_area_id,
						'jenjang_id' : jenjang_id,
						'level' : level,
					},
					success: function(data){
						$("#rekom_formasi").html(data);
					}
				});
			})

			$("#jenjang_id").change(function(){
				var jenjang_id = $(this).val();
				var personnel_area_id = $("#unit_id").val();
				var level = $("#level").val();

				$.ajax({
					'url': '/mutasi/pengajuan/getFormasiJabs',
					'type': 'GET',
					'data': {
						'personnel_area_id': personnel_area_id,
						'jenjang_id' : jenjang_id,
						'level' : level,
					},
					success: function(data){
						$("#rekom_formasi").html(data);
					}
				});
			})

			$("#rekom_formasi").change(function(){
				var formasi_id = $(this).val();

				$.ajax({
					'url': '/mutasi/pengajuan/getRekomFormasi',
					'type': 'GET',
					'data': {
						'formasi_id': formasi_id,
					},
					success: function(data){
						$("#posisi_pada_unit").text(data);
					}
				});
			})
		</script>

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
					'url': '/mutasi/pengajuan/get_pegawai_info_bursa',
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
					'url': '/mutasi/pengajuan/get_pegawai_info_bursa',
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
							if(data.result == 'true'){
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
							}else{
								swal({
								  type: 'error',
								  title: 'Oops...',
								  text: 'Dear Admin '+ "{{ auth()->user()->nama_pendek }}" +', Pegawai tidak berada dalam kewenangan anda!',
								})
							}
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
			}
		});
	</script>

	<script>
		$("#rekom_unit").change(function(){
			var unit_id = $(this).val();

			$.ajax({
				'url': '/mutasi/pengajuan/getFormasi',
				'type': 'GET',
				'data': {
					'unit_id': unit_id,
				},
				'dataType': 'json',
				error: function(){

				},
				success: function(data){
					var formasi = $("#rekom_formasi");
					formasi.empty();
					formasi.append('<option>--- Formasi ---</option>');
					formasi.removeAttr('disabled');
					$.each(data, function(key, value){
						formasi.append('<option value="'+value.formasi+'">'+value.formasi+'</option>');
					});
				}
			});
		});

		$("#rekom_formasi").change(function(){
			var formasi = $(this).val();
			var unit_id = $("#rekom_unit").val();

			$.ajax({
				'url': '/mutasi/pengajuan/getJabatan',
				'type': 'GET',
				'data': {
					'unit_id': unit_id,
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
						jabatan.append('<option value="'+key+'">'+value+'</option>');
					});
				}
			});
	    });
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
