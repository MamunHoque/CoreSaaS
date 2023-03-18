@extends('layouts.app',[
	'title' => 'Profile'
])
@section('content')
    <div class="row">
        <div class="col-md-4 col-xl-3">
            <div class="card mb-3">
                <div class="card-body text-center">
                    <img src="img/avatars/avatar.jpg" alt="Christina Mason" class="img-fluid rounded-circle mb-2" width="128" height="128" />
                    <h5 class="card-title mb-0">{{auth()->user()->name}}</h5>
                    <div class="text-muted mb-2">Lead Developer</div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Account Settings</h5>
                </div>

                <div class="list-group list-group-flush" role="tablist">
                    <a class="list-group-item list-group-item-action active" data-bs-toggle="list" href="#account" role="tab" aria-selected="true">
                        Account
                    </a>
                    <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#email" role="tab" aria-selected="false" tabindex="-1">
                        Email
                    </a>
                    <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#password" role="tab" aria-selected="false" tabindex="-1">
                        Password
                    </a>
                    <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#" role="tab" aria-selected="false" tabindex="-1">
                        Security
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-8 col-xl-9">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="account" role="tabpanel">

                    <div class="card">
                        <div class="card-header">

                            <h5 class="card-title mb-0">Public info</h5>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label class="form-label" for="inputUsername">Username</label>
                                            <input type="text" class="form-control" id="inputUsername" placeholder="Username">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="inputUsername">Biography</label>
                                            <textarea rows="2" class="form-control" id="inputBio" placeholder="Tell something about yourself"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="text-center">
                                            <img alt="Charles Hall" src="img/avatars/avatar.jpg" class="rounded-circle img-responsive mt-2" width="128" height="128">
                                            <div class="mt-2">
                                                <span class="btn btn-primary"><i class="fas fa-upload"></i> Upload</span>
                                            </div>
                                            <small>For best results, use an image at least 128px by 128px in .jpg format</small>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </form>

                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">

                            <h5 class="card-title mb-0">Private info</h5>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="inputFirstName">First name</label>
                                        <input type="text" class="form-control" id="inputFirstName" placeholder="First name">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="inputLastName">Last name</label>
                                        <input type="text" class="form-control" id="inputLastName" placeholder="Last name">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="inputAddress">Address</label>
                                    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="inputAddress2">Address 2</label>
                                    <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label" for="inputCity">City</label>
                                        <input type="text" class="form-control" id="inputCity">
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label class="form-label" for="inputState">State</label>
                                        <select id="inputState" class="form-control">
                                            <option selected="">Choose...</option>
                                            <option>...</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-2">
                                        <label class="form-label" for="inputZip">Zip</label>
                                        <input type="text" class="form-control" id="inputZip">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </form>

                        </div>
                    </div>

                </div>
                <div class="tab-pane fade" id="email" role="tabpanel">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Email</h5>

                            <form>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="inputPasswordCurrent">Current Email</label>
                                    <input type="text" value="mamun@mamun.com" disabled class="form-control" id="currentEmail">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="inputFirstName">New email</label>
                                    <input type="text" class="form-control" id="newEmail" placeholder="New email">
                                </div>

                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </form>

                        </div>
                    </div>
                </div>
                @include('profile.partials.update-password-form')
                <div class="tab-pane fade" id="security" role="tabpanel">

                </div>
            </div>
        </div>
    </div>
@endsection
