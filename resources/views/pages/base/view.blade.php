@extends('layouts.master')

@section('title', 'Create '.$title)

@section('leftbar')
	@include('includes.superadmin.leftbar')
@endsection

@section('content')
<!-- page title -->
<header id="page-header">
    <h1>{{ 'View Detail '.$title }}</h1>
</header>
<!-- /page title -->

<div id="content" class="padding-20">
    <div class="row">
        <div class="col-md-12" >
            <!-- data pegawainya -->
            <div class="panel panel-default">
                <div class="panel-heading panel-heading-transparent">
                    <strong>{{ 'View Detail '.$title }}</strong>
                </div>

                <div class="panel-body">
					<table class="table table-responsive table-hover table-striped">
						@foreach($model as $key => $row)
							<tr>
								<td>{{ ucwords(str_replace("_"," ",$key)) }}</td>
								<td>:</td>
								@if($key !== 'image')
									@if(strtolower(substr($row,-3)) == 'pdf' || strtolower(substr($row,-3)) == 'doc' || strtolower(substr($row,-4)) == 'docx')
										<td><a href="{{ asset($row) }}" download class="btn btn-xs btn-primary"><span class="fa fa-download"></span>
											Download {{ ucwords(str_replace("_"," ",$key)) }}</a></td>

									@elseif(strtolower(substr($row,-3)) == 'png' || strtolower(substr($row,-3)) == 'jpg' || strtolower(substr($row,-4)) == 'jpeg')
										<td><a href="{{ asset($row) }}" ><img src="{{ asset(asset($row)) }}" width="150" /></a>
											<a href="{{ asset($row) }}" download class="btn btn-xs btn-primary"><span class="fa fa-download"></span>
												Download {{ ucwords(str_replace("_"," ",$key)) }}</a></td>
									@else
										<td>{{ $row }}</td>
									@endif
								@else
									@if(isset($row))
										<td><a href="{{ asset($row) }}" ><img src="{{ asset(asset($row)) }}" width="150" /></a>
											<a href="{{ asset($row) }}" download class="btn btn-xs btn-primary"><span class="fa fa-download"></span>
												Download {{ ucwords(str_replace("_"," ",$key)) }}</a></td>
									@else
										<td><img src="{{ asset(asset('assets/images/noavatar.jpg')) }}" width="150" /></td>
									@endif
		                        @endif
							</tr>
						@endforeach
					</table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
