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
                <div class="col-md-6">
                    <ul id="tree1">
                        <!-- <p class="well" style="height:135px;"><strong>Initialization no parameters</strong>

                        </p> -->
                        @foreach($legacies as $legacy)
                            <li>
                                <a href="#">{{ $legacy->lookup }}</a>
                                <ul id="{{ $legacy->legacy_code }}">
                                    <!-- <li>Company Maintenance</li>
                                    <li>Employees
                                        <ul>
                                            <li>Reports
                                                <ul>
                                                    <li>Report1</li>
                                                    <li>Report2</li>
                                                    <li>Report3</li>
                                                </ul>
                                            </li>
                                            <li>Employee Maint.</li>
                                        </ul>
                                    </li>
                                    <li>Human Resources</li> -->
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </div>

                
			</div>
		</div>
	</div>

@endsection
@section('includes-scripts')
	@parent
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
@endsection
