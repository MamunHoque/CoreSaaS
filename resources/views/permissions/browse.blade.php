@extends('layouts.app',[
	'header' => __('ln.permissions'),
	'create_new' => 'permissions.create',
])
@section('header')
Permissions
@endsection

@section('content')
	<div class="row">
		<div class="col-12">
			<div class="card">
                <div class="card-header">
                    <h5 class="card-title">DataTables Ajax Sourced Data</h5>
                    <h6 class="card-subtitle text-muted">DataTables has the ability to read data from virtually any JSON data source that can be
                        obtained by Ajax. See official documentation <a href="https://datatables.net/examples/data_sources/ajax.html" target="_blank" rel="noopener noreferrer nofollow">here</a>.</h6>
                </div>
				<div class="card-body">
					@include('layouts.message')

                    <table class="table table-bordered no-footer" style="width:100%" id = "permissions-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('ln.id') }}</th>
                            <th>{{ __('ln.permission') }} {{ __('ln.key') }}</th>
                            <th>{{ __('ln.label') }}</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>

				</div>
			</div>
		</div>
	</div>
@stop
