@extends('layouts.master')

@section('title', $title)

@section('leftbar')
	@include('includes.superadmin.leftbar')
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
					<strong>Tabel {{ $title }}</strong> <!-- panel title -->
				</span>

				<!-- right options -->
				<ul class="options pull-right list-inline">
					<li><a href="#" class="opt panel_fullscreen hidden-xs" data-toggle="tooltip" title="" data-placement="bottom" data-original-title="Fullscreen"><i class="fa fa-expand"></i></a></li>
				</ul>
				<!-- /right options -->

			</div>

			<!-- panel content -->
			<div class="panel-body">
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
				<ul class="options list-inline">
					@if(in_array('filter',$actions))
						<form action="" method="get">
							<select name="personnel_area" class="form-control" onchange="this.form.submit()">
								@foreach($filter as $f)
									@if($f->personnel_area == 'PLN')
										<option value="{{ $f->personnel_area }}"
											{{ $f->personnel_area == request()->personnel_area ? 'selected':null }}>{{ $f->personnel_area }}</option>
									@else
										<option value="{{ $f->personnel_area }}"
											{{ $f->personnel_area == request()->personnel_area ? 'selected':null }}>{{ $f->personnel_area }}</option>
									@endif
								@endforeach
							</select>
						</form>
					@endif
				</ul>
				<div class="table-responsive">
					<table class="table table-bordered table-striped table-hover dataTable js-exportable" id="datatable">
	                    <thead>
	                        <tr>
								@foreach($columns as $column)
	                            	<th>{{ ucwords(str_replace('_',' ',$column)) }}</th>
								@endforeach
								<th></th>
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

@endsection

@section('includes-scripts')
	@parent
	<script>
        $(function(){
			$('#importFile').hide();
            $('#datatable').DataTable({
                "processing": true,
                "serverSide": true,
                // "autoWidth": true,
                "order": [[ 0, "asc" ]],
                "ajax":{
                    "url": "{{ url(request()->segment(1).'/datatables/ajax') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data":{ _token: "{{ csrf_token() }}", personnel_area:"{{ request()->personnel_area }}"}
                },
                "columns": {!! $tables !!}
            });
        });

		$('#btnImport').click(function(){
			$('#importFile').fadeIn(500);
		});

    </script>

	<script src="{{ asset('') }}/assets/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="{{ asset('') }}/assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="{{ asset('') }}/assets/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="{{ asset('') }}/assets/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="{{ asset('') }}/assets/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="{{ asset('') }}/assets/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="{{ asset('') }}/assets/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="{{ asset('') }}/assets/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>


@endsection
