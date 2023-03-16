@extends('layouts.master', [
	'title' => __('ln.edit') . ' ' . __('ln.roles'),
	'breadcrumb' => [ 'roles.index' => __('ln.roles'), '0' => __('ln.edit') ]
])

@section('content')
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">{{ __('ln.edit') }} {{ __('ln.role') }}</h4>
					
					@include('layouts.error')
					
					@include('roles.form', [
						'mode'	=> 'edit'
					])

				</div>
			</div>
		</div>
	</div>
@stop