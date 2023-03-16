@php
	$permission = new Parser($permission ?? null);
@endphp
@if($mode == "create")
	<form class="mt-4" action = "{{ route('permissions.store') }}" method = "POST">
@else
	<form class="mt-4" action = "{{ route('permissions.update', $permission->id) }}" method = "POST">
		{{ method_field('PATCH') }}
@endif

	<div class="form-group">
		<label for="">{{ __('ln.permission') }} {{ __('ln.name') }} *</label>
		<input type="text" class="form-control" name="name" value = "{{ $permission->name }}" placeholder="Ex: read_data" required>
	</div>
	<div class="form-group">
		<label for="">{{ __('ln.permission') }} {{ __('ln.label') }}</label>
		<input type="text" class="form-control" name="label" value = "{{ $permission->label }}" placeholder="Permission label">
	</div>
	<div class="form-group">
		<label for="">{{ __('ln.table') }} {{ __('ln.name') }}</label>
		<select name="table_name" class = "form-control select">
			<option value="">Choose</option>
			@forelse (Table::list() as $table)
				@if (!Table::void($table))
					<option value="{{ $table }}"
						@if($table == $permission->table_name)
							selected
						@endif>
						{{ ucfirst($table) }}
					</option>
				@endif
			@empty
			@endforelse
		</select>
	</div>
	
	<div class="form-group">
			@csrf
			<button type="submit" class="btn btn-primary">{{ __('ln.submit') }}</button>
	</div>

</form>