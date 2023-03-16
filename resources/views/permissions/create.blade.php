@extends('layouts.master', [
	'title' => __('ln.create') . ' ' . __('ln.new') . ' ' . __('ln.permission'),
	'breadcrumb' => [ 'permissions.index' => __('ln.permissions'), '0' => __('ln.create') ]
])

@section('content')
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">{{ __('ln.create') }} {{ __('ln.permission') }}</h4>

					@include('layouts.error')
					
					@include('settings.permissions.form', [
						'mode'	=> 'create'
					])

				</div>
			</div>
		</div>
	</div>
@stop