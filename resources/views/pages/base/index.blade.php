@extends('layouts.master')

@section('title', $title)

@section('leftbar')
	@include('includes.sdm.leftbar')
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
						<li><a href="{{ url(strtolower($title).'/create') }}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add New Data</a></li>
					@endif
					@if(in_array('export',$actions))
						<li><a href="{{ url(strtolower($title).'/export') }}" class="btn btn-sm btn-success"><i class="fa fa-file-excel-o"></i> Export to Excel</a></li>
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
            $('#datatable').DataTable({
                "processing": true,
                "serverSide": true,
                // "autoWidth": true,
                "order": [[ 0, "asc" ]],
                "ajax":{
                    "url": "{{ url(strtolower($title).'/datatables/ajax') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data":{ _token: "{{ csrf_token() }}"}
                },
                "columns": {!! $tables !!}
            });
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
