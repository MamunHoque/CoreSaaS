@extends('layouts.master', [
	'title' => __('ln.edit') . ' ' . __('ln.permissions'),
	'breadcrumb' => [ 'permissions.index' => __('ln.permissions'), '0' => __('ln.edit') ]
])

@section('content')
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">{{ __('ln.edit') }} {{ __('ln.permission') }}</h4>
					
					@include('layouts.error')
					
					@include('settings.permissions.form', [
						'mode'	=> 'edit'
					])

				</div>
			</div>
		</div>
	</div>
@stop