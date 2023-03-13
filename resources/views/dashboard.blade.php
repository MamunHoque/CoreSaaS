@extends('layouts.app')

@section('title',  __('Dashboard'))
@section('header',  __('Dashboard'))
@section('content')
    <div class="row">
        {{ __("You're logged in!") }}
    </div>
@endsection
