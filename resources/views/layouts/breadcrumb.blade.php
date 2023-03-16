@if ($create_new)
    @php
        $create_new = is_array($create_new) ? $create_new : [$create_new];
    @endphp
    <a href="{{ route(...$create_new) }}" class="btn btn-primary float-end mt-n1"><i class="fas fa-plus"></i> {{ __('ln.create-new') }}</a>
@endif

@if (isset($header))
    <div class="mb-3">
        <h1 class="h3 d-inline align-middle">{{$header}}</h1></a>
    </div>
@endif
