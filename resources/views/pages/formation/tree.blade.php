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
                        <!-- <p class="well" style="height:135px;"><strong>Initialization no parameters</strong>

                        </p> -->
                        @foreach($legacies as $l1)
                            <li id="{{ $l1->legacy_code }}">
                                <a href="#">{{ $l1->lookup }}</a>
								@if(count(getLegacyChild($l1->legacy_code)) !== 0)
	                                <ul>
										@foreach(getLegacyChild($l1->legacy_code) as $l2)
		                                    <li><a href="#">{{ $l2->lookup }}</a>
												@if(count(getLegacyChild($l2->legacy_code)) !== 0)
													<ul>
													   @foreach(getLegacyChild($l2->legacy_code) as $l3)
														   <li><a href="#">{{ $l3->lookup }}</a>
															   @if(count(getLegacyChild($l3->legacy_code)) !== 0)
																   <ul>
																	   @foreach(getLegacyChild($l3->legacy_code) as $l4)
																		   <li><a href="#">{{ $l4->lookup }}</a>
																			   @if(count(getLegacyChild($l4->legacy_code)) !== 0)
																				   <ul>
																					   @foreach(getLegacyChild($l4->legacy_code) as $l5)
																						   <li><a href="#">{{ $l5->lookup }}</a>
																							   @if(count(getLegacyChild($l5->legacy_code)) !== 0)
																								   <ul>
																										@foreach(getLegacyChild($l5->legacy_code) as $l6)
																											<li><a href="#">{{ $l6->lookup }}</a>
																												@if(count(getLegacyChild($l6->legacy_code)) !== 0)
																													{{--<ul>
																													   @foreach(getLegacyChild($l6->legacy_code) as $l7)
																														   <li><a href="#">{{ $l7->lookup }}</a>
																															   @if(count(getLegacyChild($l7->legacy_code)) !== 0)
																																   <ul>
																																		@foreach(getLegacyChild($l7->legacy_code) as $l8)
																																			<li><a href="#">{{ $l8->lookup }}</a>
																																				@if(count(getLegacyChild($l8->legacy_code)) !== 0)
																																					<ul>

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
@push('includes-styles')
	<link rel="stylesheet" href="{{ asset('') }}/assets/plugins/jquery-datatable/dataTables.editor.min.js">
@endpush
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
	<script src="{{ asset('') }}/assets/plugins/jquery-datatable/dataTables.editor.min.js"></script>

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
                    "data":{ _token: "{{ csrf_token() }}"}
                },
                "columns": {!! $tables !!}
            });

			editor = new $.fn.dataTable.Editor( {
		        ajax: "{{ url(request()->segment(1).'/datatables/edit') }}",
		        table: "#datatable",
		        fields: [ {
		                label: "Legacy Code:",
		                name: "legacy_code"
		            }, {
		                label: "Kode Olah:",
		                name: "kode_olah"
		            }, {
		                label: "Personnel Area ID:",
		                name: "personnel_area_id"
		            }, {
		                label: "Level:",
		                name: "level"
		            }, {
		                label: "Formasi:",
		                name: "formasi"
		            }, {
		                label: "Jabatan:",
		                name: "jabatan"
		            }
		        ]
		    } );

			// Activate an inline edit on click of a table cell
		    $('#datatable').on( 'click', 'tbody td:not(:first-child)', function (e) {
			    editor.inline( this );
		    } );
        });

		$('#btnImport').click(function(){
			$('#importFile').fadeIn(500);
		});

    </script>

@endsection
