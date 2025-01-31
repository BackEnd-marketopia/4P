@extends('admin.layouts.app')
@section('title', 'Configurations')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">{{ __('message.Configurations') }}</h3>
                <h6 class="op-7 mb-2">4P</h6>
            </div>
            {{-- <div class="ms-md-auto">
                <a href="{{ route('admin.cities.edit', $config->id) }}"
                    class="btn btn-secondary btn-round">{{ __('message.Edit') }}</a>
            </div> --}}
        </div>
        <form action="{{ route('admin.configStore', $config->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group
                                                {{ $errors->has('android_version') ? ' has-danger' : '' }}">
                                                <label for="android_version">{{ __('message.android_version') }}</label>
                                                <input type="text" class="form-control" id="android_version" name="android_version"
                                                    value="{{ $config->android_version }}" required>
                                            </div>
                                            @if ($errors->has('android_version'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('android_version') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group
                                                {{ $errors->has('ios_version') ? ' has-danger' : '' }}">
                                                <label for="ios_version">{{ __('message.ios_version') }}</label>
                                                <input type="text" class="form-control" id="ios_version" name="ios_version"
                                                value="{{ $config->ios_version }}" required>
                                            </div>
                                            @if ($errors->has('ios_version'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('ios_version') }}</strong>
                                                </span>
                                            @endif
                                        </div><div class="col-md-6">
                                            <div class="form-group
                                                {{ $errors->has('android_url') ? ' has-danger' : '' }}">
                                                <label for="android_url">{{ __('message.android_url') }}</label>
                                                <input type="text" class="form-control" id="android_url" name="android_url" value="{{ $config->android_url }}" required>
                                            </div>
                                            @if ($errors->has('android_url'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('android_url') }}</strong>
                                                </span>
                                            @endif
                                        </div><div class="col-md-6">
                                            <div class="form-group
                                                {{ $errors->has('ios_url') ? ' has-danger' : '' }}">
                                                <label for="ios_url">{{ __('message.ios_url') }}</label>
                                                <input type="text" class="form-control" id="ios_url" name="ios_url" value="{{ $config->ios_url }}" required>
                                            </div>
                                            @if ($errors->has('ios_url'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('ios_url') }}</strong>
                                                </span>
                                            @endif
                                        </div><div class="col-md-12">
                                            <div class="form-group
                                                {{ $errors->has('terms_and_conditions') ? ' has-danger' : '' }}">
                                                <label for="terms_and_conditions">{{ __('message.terms_and_conditions') }}</label>
                                                <textarea type="text" class="form-control" id="terms_and_conditions" 
                                                name="terms_and_conditions" required>{{ $config->terms_and_conditions }}
                                                </textarea>
                                            </div>
                                            @if ($errors->has('terms_and_conditions'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('terms_and_conditions') }}</strong>
                                                </span>
                                            @endif
                                        </div><div class="col-md-12">
                                            <div class="form-group
                                                {{ $errors->has('about_us') ? ' has-danger' : '' }}">
                                                <label for="about_us">{{ __('message.about_us') }}</label>
                                                <textarea type="text" class="form-control" id="about_us" name="about_us" 
                                                required>{{ $config->about_us }}</textarea>
                                            </div>
                                            @if ($errors->has('about_us'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('about_us') }}</strong>
                                                </span>
                                            @endif
                                        </div><div class="col-md-12">
                                            <div class="form-group
                                                {{ $errors->has('privacy_policy') ? ' has-danger' : '' }}">
                                                <label for="naprivacy_policyme">{{ __('message.privacy_policy') }}</label>
                                                <textarea type="text" class="form-control" id="privacy_policy" name="privacy_policy" 
                                                required>{{ $config->privacy_policy }}</textarea>
                                            </div>
                                            @if ($errors->has('privacy_policy'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('privacy_policy') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-md-12">
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