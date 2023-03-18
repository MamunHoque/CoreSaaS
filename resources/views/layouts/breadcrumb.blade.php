@if (isset($title))
    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3><strong>{{$title}}</strong></h3>
        </div>

        <div class="col-auto ms-auto text-end mt-n1">
            @if ($create_new)
                @php
                    $create_new = is_array($create_new) ? $create_new : [$create_new];
                @endphp
                <a href="{{ route(...$create_new) }}" class="btn btn-primary float-end mt-n1"><i class="fas fa-plus"></i> {{ __('ln.create-new') }}</a>
            @endif
        </div>
    </div>
@endif
