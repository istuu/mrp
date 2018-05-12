@extends('layouts.master')

@section('title', $title)

@section('leftbar')
	@include('includes.sdm.leftbar')
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

    </script>

@endsection
