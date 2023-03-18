@extends('layouts.app',[
	'title' => __('ln.permissions'),
	'create_new' => 'permissions.create',
])
@section('content')
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					@include('layouts.message')
                    <table class="table table-bordered no-footer" id = "permissions-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('ln.id') }}</th>
                            <th>{{ __('ln.permission') }}</th>
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
