<div class="tab-pane fade" id="password" role="tabpanel">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Password</h5>
            <h6 class="card-subtitle text-muted">{{ __('Ensure your account is using a long, random password to stay secure.') }}</h6>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('password.update') }}" class="needs-validation">
                @csrf
                @method('put')
                <div class="mb-3">
                    <label class="form-label" for="current_password">{{__('Current Password')}}</label>
                    <input id="current_password" name="current_password" type="password" class="form-control" autocomplete="current-password" >
                    <div class="invalid-feedback">
                        {{$errors??$errors->updatePassword->get('current_password')}}
                    </div>
                    <small><a href="#">Forgot your password?</a></small>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="password">{{__('New Password')}}</label>
                    <input type="password" class="form-control" id="password" id="password" name="password" autocomplete="new-password">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="password_confirmation">{{__('Confirm Password')}}</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" autocomplete="new-password" >
                </div>
                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
            </form>
        </div>
    </div>
</div>
