@extends('layouts.master',[
	'title' => __('ln.roles'),
	'breadcrumb' => [ __('ln.roles') ],
	'create_new' => 'roles.create',
])

@section('content')
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					
					@include('layouts.message')

					<table class="table table-bordered table-striped no-footer mt-4" id = "roles-table">
						<thead>
							<tr>
								<th>#</th>
								<th>{{ __('ln.id') }}</th>
								<th>{{ __('ln.role') }}</th>
								<th>{{ __('ln.label') }}</th>
								<th></th>
							</tr>
						</thead>
					</table>

				</div>
			</div>
		</div>
	</div>
@stop