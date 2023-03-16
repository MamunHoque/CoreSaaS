@php
	$role = new Parser($role ?? null);
	$permissionSet = isset($permissionSet) ? $permissionSet : [];
@endphp
@if($mode == "create")
	<form class="mt-4" action = "{{route('roles.store')}}" method = "POST">
@else
	<form class="mt-4" action = "{{route('roles.update', $role->id)}}" method = "POST">
		{{method_field('PATCH')}}
@endif
	<div class="form-group">
		<label for="name">{{ __('ln.role') }} {{ __('ln.name') }} *</label>
		<input type="text" class="form-control" name="name" value = "{{$role->name}}" placeholder="Ex: read_data" required>
	</div>
	<div class="form-group">
		<label for="label">{{ __('ln.role') }} {{ __('ln.label') }}</label>
		<input type="text" class="form-control" name="label" value = "{{$role->label}}" placeholder="Role label">
	</div>
	<div class="form-group">
		<label for="">{{ __('ln.permissions') }}</label>
		@forelse($permissions as $key => $permission)
			<div class="role_set">
				<div class="custom-control custom-checkbox mb-2">
					<input type="checkbox" class="custom-control-input bulk-check" id="{{$key?:'default'}}">
					<label class="custom-control-label" for="{{$key?:'default'}}">{{ucfirst($key)}}</label>
				</div>
				<ul>
					@forelse( $permission['id'] as $i => $per)
						<li class="custom-control custom-checkbox mb-1">
							<input type="checkbox" class="custom-control-input" name="{{'role_'.$per}}" id="{{'role_'.$per}}"
								@if(in_array($per, $permissionSet)) checked @endif>
							<label class="custom-control-label" for="{{'role_'.$per}}">{{$permission['label'][$i]}}</label>
						</li>
					@empty
					@endforelse
				</ul>				
			</div>
		@empty
		@endforelse
	</div>
	
	<div class="form-group">
			@csrf
			<button type="submit" class="btn btn-primary">{{ __('ln.submit') }}</button>
	</div>

</form>