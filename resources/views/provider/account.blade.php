@extends('provider.layouts.app')
@section('title', 'My Account')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">{{ __('message.Profile') }}</h3>
                    <h6 class="op-7 mb-2">4P</h6>
                </div>
                {{-- <div class="ms-md-auto">
                    <a href="{{ route('admin.profileMe') }}" class="btn btn-secondary btn-round">{{ __('message.Edit
                        Profile') }}</a>
                </div> --}}
            </div>
            <form action="{{ route('provider.accountStore') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="avatar avatar-xl">
                                            <img src="{{ asset(auth('web')->user()->image) }}" alt="..."
                                                class="avatar-img rounded-circle">
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div
                                                    class="form-group
                                                                                                        {{ $errors->has('name') ? ' has-danger' : '' }}">
                                                    <label for="name">{{ __('message.Name') }}</label>
                                                    <input type="text" class="form-control" id="name" name="name"
                                                        value="{{ auth('web')->user()->name }}" required>
                                                </div>
                                                @if ($errors->has('name'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group {{ $errors->has('email') ? ' has-danger' : '' }}">
                                                    <label for="email">{{ __('message.Email') }}</label>
                                                    <input type="email" class="form-control" id="email" name="email"
                                                        value="{{ auth('web')->user()->email }}" required>
                                                </div>
                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group {{ $errors->has('phone') ? ' has-danger' : '' }}">
                                                    <label for="phone">{{ __('message.Phone') }}</label>
                                                    <input type="text" class="form-control" id="phone" name="phone"
                                                        value="{{ auth('web')->user()->phone }}" required>
                                                </div>
                                                @if ($errors->has('phone'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('phone') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group {{ $errors->has('image') ? ' has-danger' : '' }}">
                                                    <label for="image">{{ __('message.Profile Image') }}</label>
                                                    <input type="file" class="form-control" id="image" name="image">
                                                </div>
                                                @if ($errors->has('image'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('image') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <div
                                                    class="form-group {{ $errors->has('password') ? ' has-danger' : '' }} position-relative">
                                                    <label for="password">{{ __('message.Password') }}</label>
                                                    <input type="password"
                                                        class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                        id="password" name="password">
                                                    <i id="eye-icon" class="fa fa-eye position-absolute"
                                                        style="right: 20px; top: 65%; transform: translateY(-50%); cursor: pointer; z-index: 10;"
                                                        onclick="togglePassword()"></i>
                                                </div>
                                                @if ($errors->has('password'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <div
                                                    class="form-group {{ $errors->has('password_confirmation') ? ' has-danger' : '' }}">
                                                    <label
                                                        for="password_confirmation">{{ __('message.Confirm Password') }}</label>
                                                    <input type="password" class="form-control" id="password_confirmation"
                                                        name="password_confirmation">
                                                </div>
                                                @if ($errors->has('password_confirmation'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <button class="btn btn-secondary"
                                                        type="submit">{{ __('message.Edit') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection