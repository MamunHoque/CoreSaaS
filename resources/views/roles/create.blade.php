@extends('layouts.master', [
	'title' => __('ln.create') . ' ' . __('ln.new') . ' ' . __('ln.role'),
	'breadcrumb' => [ 'roles.index' => __('ln.roles'), '0' => __('ln.create') ]
])

@section('content')
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">{{ __('ln.create') }} {{ __('ln.role') }}</h4>

					@include('layouts.error')
					
					@include('roles.form', [
						'mode'	=> 'create'
					])

				</div>
			</div>
		</div>
	</div>
@stop