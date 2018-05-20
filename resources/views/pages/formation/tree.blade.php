@extends('layouts.master')

@section('title', $title)

@section('leftbar')
	@include('includes.superadmin.leftbar')
@endsection

@section('includes-styles')
	@parent

	<link href="{{ asset('css/tree.css') }}" rel="stylesheet">
@endsection

@section('content')
	<div id="content" class="dashboard padding-20">
		<div id="panel-1" class="panel panel-default">
			<div class="panel-heading">
				<span class="title elipsis">
					<strong>{{ $title }}</strong> <!-- panel title -->
				</span>

				<!-- right options -->
				<ul class="options pull-right list-inline">
					<li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title=""
                        data-placement="bottom" data-original-title="Fullscreen"><i class="fa fa-expand"></i></a></li>
				</ul>
				<!-- /right options -->

			</div>

			<!-- panel content -->
			<div class="panel-body">
                <div class="col-md-4">
                    <ul id="tree2">
                        @foreach($legacies as $l1)
                            <li>
                                <a onclick="getDataFormation({{ $l1->legacy_code }})">{{ $l1->nama_panjang }}</a>
									{!! actionTree($l1) !!}
								@if(count(getLegacyChild($l1->legacy_code)) !== 0)
	                                <ul>
										@foreach(getLegacyChild($l1->legacy_code) as $l2)
		                                    <li><a onclick="getDataFormation({{ $l2->legacy_code }})">{{ $l2->nama_panjang }}</a>
												{!! actionTree($l2) !!}
												@if(count(getLegacyChild($l2->legacy_code)) !== 0)
													<ul>
													   @foreach(getLegacyChild($l2->legacy_code) as $l3)
														   <li><a onclick="getDataFormation({{ $l3->legacy_code }})">{{ $l3->nama_panjang }}</a>
															   {!! actionTree($l3) !!}
															   @if(count(getLegacyChild($l3->legacy_code)) !== 0)
																   <ul>
																	   @foreach(getLegacyChild($l3->legacy_code) as $l4)
																		   <li><a onclick="getDataFormation({{ $l4->legacy_code }})">{{ $l4->nama_panjang }}</a>
																			   {!! actionTree($l4) !!}
																			   @if(count(getLegacyChild($l4->legacy_code)) !== 0)
																				   <ul>
																					   @foreach(getLegacyChild($l4->legacy_code) as $l5)
																						   <li><a onclick="getDataFormation({{ $l5->legacy_code }})">{{ $l5->nama_panjang }}</a>
																							   {!! actionTree($l5) !!}
																							   @if(count(getLegacyChild($l5->legacy_code)) !== 0)
																								   <ul>
																										@foreach(getLegacyChild($l5->legacy_code) as $l6)
																											<li><a onclick="getDataFormation({{ $l6->legacy_code }})">{{ $l6->nama_panjang }}</a>
																												{!! actionTree($l5) !!}
																												@if(count(getLegacyChild($l6->legacy_code)) !== 0)
																													{{--<ul>
																													   @foreach(getLegacyChild($l6->legacy_code) as $l7)
																														   <li><a onclick="getDataFormation({{ $l7->legacy_code }})">{{ $l7->nama_panjang }}</a>
																															   {!! actionTree($l7) !!}
																															   @if(count(getLegacyChild($l7->legacy_code)) !== 0)
																																   <ul>
																																		@foreach(getLegacyChild($l7->legacy_code) as $l8)
																																			<li><a onclick="getDataFormation({{ $l8->legacy_code }})">{{ $l8->nama_panjang }}</a>
																																				{!! actionTree($l8) !!}
																																				@if(count(getLegacyChild($l8->legacy_code)) !== 0)
																																					<ul>
																																						@foreach(getLegacyChild($l8->legacy_code) as $l9)
																																							<li><a onclick="getDataFormation({{ $l9->legacy_code }})">{{ $l9->nama_panjang }}</a>
																																								{!! actionTree($l9) !!}
																																								@if(count(getLegacyChild($l9->legacy_code)) !== 0)
																																									<ul>

																																									</ul>
																																								@endif
																																							</li>
																																						@endforeach
																																					</ul>
																																				@endif
																																			</li>
																																		@endforeach
																																	</ul>
																															   @endif
																														   </li>
																													   @endforeach
																												   </ul> --}}
																												@endif
																											</li>
																										@endforeach
																									</ul>
																							   @endif
																						   </li>
																					   @endforeach
																				   </ul>
																			   @endif
																		   </li>
																	   @endforeach
																   </ul>
															   @endif
														   </li>
													   @endforeach
												   </ul>
												@endif
											</li>
										@endforeach
	                                </ul>
								@endif
                            </li>
                        @endforeach
                    </ul>
                </div>

				<div class="col-md-8">
					<ul class="options list-inline">
						@if(in_array('create',$actions))
							<li><a href="{{ url(request()->segment(1).'/create') }}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add New Data</a></li>
						@endif
						@if(in_array('import',$actions))
							<li><a href="{{ url(request()->segment(1).'/import') }}" class="btn btn-sm btn-primary"><i class="fa fa-upload"></i> Import from Excel</a></li>
						@endif
						@if(in_array('export',$actions))
							<li><a href="{{ url(request()->segment(1).'/export') }}" class="btn btn-sm btn-primary"><i class="fa fa-download"></i> Export to Excel</a></li>
						@endif
					</ul>
					<div class="table-responsive">
						<table class="table table-bordered table-striped table-hover dataTable js-exportable" id="datatable">
		                    <thead>
		                        <tr>
									@foreach($columns as $column)
		                            	<th>{{ ucwords(str_replace('_',' ',$column)) }}</th>
									@endforeach
									<th width="20%"></th>
		                        </tr>
		                    </thead>
		                    <tfoot>
		                        <tr>
									@foreach($columns as $column)
										<th>{{ ucwords(str_replace('_',' ',$column)) }}</th>
									@endforeach
		                            <th></th>
		                        </tr>
		                    </tfoot>
		                    <tbody>

		                    </tbody>
		                </table>
					</div>
				</div>

			</div>
		</div>
	</div>

	<div id="approveModal" class="modal right fade" tabindex="-1" role="dialog" aria-labelledby="approveModalLabel" aria-hidden="true">
	    <div class="modal-dialog">
	        <div class="modal-content">

	            <!-- Modal Header -->
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                <h4 class="modal-title" id="approveModalLabel">Approve <a href="" class="btn btn-primary edit_link" target="_blank">Edit data transaksi</a></h4>
	            </div>

	            <!-- Modal Body -->
	            <form action="/dashboard/approve_mutasi" method="POST" enctype="multipart/form-data">
	                {{ csrf_field() }}
	                <input class="mrp_id" type="hidden" name="id" value="">
	                <div class="modal-body">

	                    <div class="row form-group">
	                        <div class="col-md-12 col-sm-12">
	                            <label class="switch switch" data-toggle="collapse" data-target="#rekom_group">
	                                <input type="checkbox" name="rekom_checkbox" id="rekom_checkbox" value="0" autocomplete="off">
	                                <span class="switch-label" data-on="YES" data-off="NO"></span>
	                                <span> Ubah Formasi Jabatan Mutasi? </span>
	                            </label>
	                        </div>
	                    </div>

	                    <div class="collapse" id="rekom_group">
	                        <div class="row">
	                            <div class="col-md-12">
	                                <select class="form-control select2" id="rekom_unit" style="width: 100%" disabled onchange="getFormasi(this)">
	                                    <option>--- Pilih Unit ---</option>
	                                </select>
	                            </div>
	                        </div>

	                        <div class="row form-group">
	                            <div class="col-md-6 col-sm-6">
	                                <select class="form-control" id="rekom_formasi" disabled onchange="getJabatan(this)">
	                                    <option>--- Formasi ---</option>
	                                </select>
	                            </div>

	                            <div class="col-md-6 col-sm-6">
	                                <select class="form-control" name="kode_olah" id="rekom_jabatan" disabled>
	                                    <option>--- Jabatan ---</option>
	                                </select>
	                            </div>
	                        </div>
	                    </div>

	                    <div class="form-group">
	                        <h4>Perintah Cetak SK *</h4>
	                        <input class="custom-file-upload" type="file" id="file" name="dokumen_mutasi" id="contact:attachment" data-btn-text="Select a File" required="" />
	                        <small class="text-muted block">Max file size: 10Mb (pdf)</small>
	                    </div>

	                    <div class="form-group">
	                        <h4>No. Dokumen *</h4>
	                        <input type="text" class="form-control" name="no_dokumen_respon_sdm" required="">
	                    </div>

	                    <div class="form-group">
	                        <h4>Tindak Lanjut *</h4>
	                        <!-- select -->
	                        <div class="fancy-form fancy-form-select">
	                            <select class="form-control" name="tindak_lanjut" required="">
	                                <option>--- PILIH ---</option>
	                                <option value="Cetak SK Definitif">Cetak SK Definitif</option>
	                                <option value="Cetak SK Fungsional">Cetak SK Fungsional</option>
	                                <option value="Cetak SK Fungsional & Surat Tugas PLT">Cetak SK Fungsional & Surat Tugas PLT</option>
	                                <option value="Cetak SK Fungsional Pembatalan SK Lama">Cetak SK Fungsional Pembatalan SK Lama</option>
	                                <option value="Cetak SK Ijin di Luar Tanggungan">Cetak SK Ijin di Luar Tanggungan</option>
	                                <option value="Cetak Surat Tugas PLT">Cetak Surat Tugas PLT</option>
	                                <option value="Pending">Pending</option>
	                            </select>
	                            <i class="fancy-arrow"></i>
	                        </div>
	                    </div>
	                </div>

	                <!-- Modal Footer -->
	                <div class="modal-footer">
	                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
	                    <button type="submit" class="btn btn-primary">Simpan</button>
	                    {{-- <button type="button" class="btn btn-primary toastr-notify" data-progressBar="true" data-position="top-right" data-notifyType="success" data-message="Berhasil disimpan dan Dikirim" data-dismiss="modal">Simpan</button> --}}
	                </div>
	            </form>
	        </div>
	    </div>
	</div>

	<div id="approveReqJabatan" class="modal right fade" tabindex="-1" role="dialog" aria-labelledby="approveReqJabatanLabel" aria-hidden="true">
	    <div class="modal-dialog">
	        <div class="modal-content">

	            <!-- Modal Header -->
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                <h4 class="modal-title" id="approveReqJabatanLabel">Approve <a href="" class="btn btn-primary edit_link" target="_blank">Edit data transaksi</a></h4>
	            </div>

	            <!-- Modal Body -->
	            <form action="/dashboard/approve_mutasi" method="POST" enctype="multipart/form-data">
	                {{ csrf_field() }}
	                <input class="mrp_id" type="hidden" name="id" value="">
	                <div class="modal-body">

	                    <div class="form-group">
	                        <h4>NIP Penerima Mutasi *</h4>
	                        <input type="text" class="form-control" style="text-transform: uppercase" name="nip" required="">
	                    </div>

	                    <div class="form-group">
	                        <h4>Perintah Cetak *</h4>
	                        <input class="custom-file-upload" type="file" id="file" name="dokumen_mutasi" id="contact:attachment" data-btn-text="Select a File" required="" />
	                        <small class="text-muted block">Max file size: 10Mb (pdf)</small>
	                    </div>

	                    <div class="form-group">
	                        <h4>No. Dokumen *</h4>
	                        <input type="text" class="form-control" name="no_dokumen_respon_sdm" required="">
	                    </div>

	                    <div class="form-group">
	                        <h4>Tindak Lanjut *</h4>
	                        <!-- select -->
	                        <div class="fancy-form fancy-form-select">
	                            <select class="form-control" name="tindak_lanjut" required="">
	                                <option>--- PILIH ---</option>
	                                <option value="Cetak SK Definitif">Cetak SK Definitif</option>
	                                <option value="Cetak SK Fungsional">Cetak SK Fungsional</option>
	                                <option value="Cetak SK Fungsional & Surat Tugas PLT">Cetak SK Fungsional & Surat Tugas PLT</option>
	                                <option value="Cetak SK Fungsional Pembatalan SK Lama">Cetak SK Fungsional Pembatalan SK Lama</option>
	                                <option value="Cetak SK Ijin di Luar Tanggungan">Cetak SK Ijin di Luar Tanggungan</option>
	                                <option value="Cetak Surat Tugas PLT">Cetak Surat Tugas PLT</option>
	                                <option value="Pending">Pending</option>
	                            </select>
	                            <i class="fancy-arrow"></i>
	                        </div>
	                    </div>
	                </div>

	                <!-- Modal Footer -->
	                <div class="modal-footer">
	                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
	                    <button type="submit" class="btn btn-primary">Simpan</button>
	                    {{-- <button type="button" class="btn btn-primary toastr-notify" data-progressBar="true" data-position="top-right" data-notifyType="success" data-message="Berhasil disimpan dan Dikirim" data-dismiss="modal">Simpan</button> --}}
	                </div>
	            </form>
	        </div>
	    </div>
	</div>

	<div id="modalLegacy" class="modal right fade" tabindex="-1" role="dialog" aria-labelledby="modalLegacy" aria-hidden="true">

	</div>


@endsection
@section('includes-scripts')
	@parent
	<script src="{{ asset('') }}/assets/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="{{ asset('') }}/assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="{{ asset('') }}/assets/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="{{ asset('') }}/assets/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="{{ asset('') }}/assets/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="{{ asset('') }}/assets/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="{{ asset('') }}/assets/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="{{ asset('') }}/assets/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>

	<script>
        $.fn.extend({
            treed: function (o) {

              var openedClass = 'glyphicon-minus-sign';
              var closedClass = 'glyphicon-plus-sign';

              if (typeof o != 'undefined'){
                if (typeof o.openedClass != 'undefined'){
                openedClass = o.openedClass;
                }
                if (typeof o.closedClass != 'undefined'){
                closedClass = o.closedClass;
                }
              };

                //initialize each of the top levels
                var tree = $(this);
                tree.addClass("tree");
                tree.find('li').has("ul").each(function () {
                    var branch = $(this); //li with children ul
                    branch.prepend("<i class='indicator glyphicon " + closedClass + "'></i>");
                    branch.addClass('branch');
                    branch.on('click', function (e) {
                        if (this == e.target) {
                            var icon = $(this).children('i:first');
                            icon.toggleClass(openedClass + " " + closedClass);
                            $(this).children().children().toggle();
                        }
                    })
                    branch.children().children().toggle();
                });
                //fire event from the dynamically added icon
              tree.find('.branch .indicator').each(function(){
                $(this).on('click', function () {
                    $(this).closest('li').click();
                });
              });
                //fire event to open branch if the li contains an anchor instead of text
                tree.find('.branch>a').each(function () {
                    $(this).on('click', function (e) {
                        $(this).closest('li').click();
                        e.preventDefault();
                    });
                });
                //fire event to open branch if the li contains a button instead of text
                tree.find('.branch>button').each(function () {
                    $(this).on('click', function (e) {
                        $(this).closest('li').click();
                        e.preventDefault();
                    });
                });
            }
        });

        //Initialization of treeviews

        $('#tree1').treed();

        $('#tree2').treed({openedClass:'glyphicon-folder-open', closedClass:'glyphicon-folder-close'});

        $('#tree3').treed({openedClass:'glyphicon-chevron-right', closedClass:'glyphicon-chevron-down'});
    </script>
	<script>
	 	$('body').addClass("loading");
        $(function(){
			$('#importFile').hide();
        });

		var table = $('#datatable').DataTable({
			"processing": true,
			"serverSide": true,
			// "autoWidth": true,
			"order": [[ 0, "asc" ]],
			"ajax":{
				"url": "{{ url(request()->segment(1).'/datatables/ajax') }}",
				"dataType": "json",
				"type": "POST",
				"data":{ _token: "{{ csrf_token() }}"}
			},
			"columns": {!! $tables !!}
		});

		$('#btnImport').click(function(){
			$('#importFile').fadeIn(500);
		});

		function getDataFormation(legacy_code){
			table.ajax.url( "{{ url(request()->segment(1).'/datatables/ajax?legacy_code=') }}"+legacy_code ).load();
		}

		function createLegacy(legacy_code){
			$.ajax( {
				type: "GET",
				url: "{{ url(request()->segment(1).'/ajax/create') }}",
				data: {
					legacy_code: legacy_code
				},
				success: function( result ) {
					$("#modalLegacy").html(result);
					$("#modalLegacy").modal();
				}
			} );
		}

		function editLegacy(id){
			$.ajax( {
				type: "GET",
				url: "{{ url(request()->segment(1).'/ajax/edit') }}",
				data: {
					id: id
				},
				success: function( result ) {
					$("#modalLegacy").html(result);
					$("#modalLegacy").modal();
				}
			} );
		}

    </script>

@endsection
