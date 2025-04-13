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
                    <a href="{{ route('admin.cities.edit', $config->id) }}" class="btn btn-secondary btn-round">{{
                        __('message.Edit') }}</a>
                </div> --}}
            </div>
            <form action="{{ route('admin.configStore', $config->id) }}" method="POST" enctype="multipart/form-data">
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
                                                <div
                                                    class="form-group
                                                                                {{ $errors->has('android_version') ? ' has-danger' : '' }}">
                                                    <label for="android_version">{{ __('message.android_version') }}</label>
                                                    <input type="text" class="form-control" id="android_version"
                                                        name="android_version" value="{{ $config->android_version }}"
                                                        required>
                                                </div>
                                                @if ($errors->has('android_version'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('android_version') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <div
                                                    class="form-group
                                                                                {{ $errors->has('ios_version') ? ' has-danger' : '' }}">
                                                    <label for="ios_version">{{ __('message.ios_version') }}</label>
                                                    <input type="text" class="form-control" id="ios_version"
                                                        name="ios_version" value="{{ $config->ios_version }}" required>
                                                </div>
                                                @if ($errors->has('ios_version'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('ios_version') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <div
                                                    class="form-group
                                                                                {{ $errors->has('android_url') ? ' has-danger' : '' }}">
                                                    <label for="android_url">{{ __('message.android_url') }}</label>
                                                    <input type="text" class="form-control" id="android_url"
                                                        name="android_url" value="{{ $config->android_url }}" required>
                                                </div>
                                                @if ($errors->has('android_url'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('android_url') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <div
                                                    class="form-group
                                                                                {{ $errors->has('ios_url') ? ' has-danger' : '' }}">
                                                    <label for="ios_url">{{ __('message.ios_url') }}</label>
                                                    <input type="text" class="form-control" id="ios_url" name="ios_url"
                                                        value="{{ $config->ios_url }}" required>
                                                </div>
                                                @if ($errors->has('ios_url'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('ios_url') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="col-md-12">
                                                <div
                                                    class="form-group
                                                                                {{ $errors->has('terms_and_conditions') ? ' has-danger' : '' }}">
                                                    <label
                                                        for="terms_and_conditions">{{ __('message.terms_and_conditions') }}</label>
                                                    <textarea type="text" class="form-control" id="terms_and_conditions"
                                                        name="terms_and_conditions" required>{{ $config->terms_and_conditions }}
                                                                                </textarea>
                                                </div>
                                                @if ($errors->has('terms_and_conditions'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('terms_and_conditions') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="col-md-12">
                                                <div
                                                    class="form-group
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
                                            </div>
                                            <div class="col-md-12">
                                                <div
                                                    class="form-group
                                                                                {{ $errors->has('privacy_policy') ? ' has-danger' : '' }}">
                                                    <label
                                                        for="naprivacy_policyme">{{ __('message.privacy_policy') }}</label>
                                                    <textarea type="text" class="form-control" id="privacy_policy"
                                                        name="privacy_policy"
                                                        required>{{ $config->privacy_policy }}</textarea>
                                                </div>
                                                @if ($errors->has('privacy_policy'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('privacy_policy') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="col-md-12">
                                                <div
                                                    class="form-group {{ $errors->has('image_of_card') ? ' has-danger' : '' }}">
                                                    <label for="image_of_card">{{ __('message.image_of_card') }}</label>
                                                    <input type="file" class="form-control" id="image_of_card"
                                                        name="image_of_card">
                                                </div>
                                                @if ($errors->has('image_of_card'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('image_of_card') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="col-md-12">
                                                <div
                                                    class="form-group {{ $errors->has('price_of_card') ? ' has-danger' : '' }}">
                                                    <label for="price_of_card">{{ __('message.price_of_card') }}</label>
                                                    <input type="float" class="form-control" id="price_of_card"
                                                        value="{{ $config->price_of_card }}" name="price_of_card">
                                                </div>
                                                @if ($errors->has('price_of_card'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('price_of_card') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="col-md-12">
                                                <div
                                                    class="form-group {{ $errors->has('description_of_card_arabic') ? ' has-danger' : '' }}">
                                                    <label
                                                        for="description_of_card_arabic">{{ __('message.description_of_card_arabic') }}</label>
                                                    <textarea type="text" class="form-control"
                                                        id="description_of_card_arabic" name="description_of_card_arabic"
                                                        required>{{ $config->description_of_card_arabic }}</textarea>
                                                </div>
                                                @if ($errors->has('description_of_card_arabic'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('description_of_card_arabic') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="col-md-12">
                                                <div
                                                    class="form-group {{ $errors->has('description_of_card_english') ? ' has-danger' : '' }}">
                                                    <label
                                                        for="description_of_card_english">{{ __('message.description_of_card_english') }}</label>
                                                    <textarea type="text" class="form-control"
                                                        id="description_of_card_english" name="description_of_card_english"
                                                        required>{{ $config->description_of_card_english }}</textarea>
                                                </div>
                                                @if ($errors->has('description_of_card_english'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('description_of_card_english') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <div
                                                    class="form-group {{ $errors->has('facebook_link') ? ' has-danger' : '' }}">
                                                    <label for="facebook_link">{{ __('message.facebook_link') }}</label>
                                                    <input type="text" class="form-control" id="facebook_link"
                                                        name="facebook_link" value="{{ $config->facebook_link }}">
                                                </div>
                                                @if ($errors->has('facebook_link'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('facebook_link') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <div
                                                    class="form-group {{ $errors->has('twitter_link') ? ' has-danger' : '' }}">
                                                    <label for="twitter_link">{{ __('message.twitter_link') }}</label>
                                                    <input type="text" class="form-control" id="twitter_link"
                                                        name="twitter_link" value="{{ $config->twitter_link }}">
                                                </div>
                                                @if ($errors->has('twitter_link'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('twitter_link') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <div
                                                    class="form-group {{ $errors->has('instagram_link') ? ' has-danger' : '' }}">
                                                    <label for="instagram_link">{{ __('message.instagram_link') }}</label>
                                                    <input type="text" class="form-control" id="instagram_link"
                                                        name="instagram_link" value="{{ $config->instagram_link }}">
                                                </div>
                                                @if ($errors->has('instagram_link'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('instagram_link') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <div
                                                    class="form-group {{ $errors->has('youtube_link') ? ' has-danger' : '' }}">
                                                    <label for="youtube_link">{{ __('message.youtube_link') }}</label>
                                                    <input type="text" class="form-control" id="youtube_link"
                                                        name="youtube_link" value="{{ $config->youtube_link }}">
                                                </div>
                                                @if ($errors->has('youtube_link'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('youtube_link') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <div
                                                    class="form-group {{ $errors->has('snapchat_link') ? ' has-danger' : '' }}">
                                                    <label for="snapchat_link">{{ __('message.snapchat_link') }}</label>
                                                    <input type="text" class="form-control" id="snapchat_link"
                                                        name="snapchat_link" value="{{ $config->snapchat_link }}">
                                                </div>
                                                @if ($errors->has('snapchat_link'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('snapchat_link') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <div
                                                    class="form-group {{ $errors->has('tiktok_link') ? ' has-danger' : '' }}">
                                                    <label for="tiktok_link">{{ __('message.tiktok_link') }}</label>
                                                    <input type="text" class="form-control" id="tiktok_link"
                                                        name="tiktok_link" value="{{ $config->tiktok_link }}">
                                                </div>
                                                @if ($errors->has('tiktok_link'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('tiktok_link') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <div
                                                    class="form-group {{ $errors->has('whatsapp_link') ? ' has-danger' : '' }}">
                                                    <label for="whatsapp_link">{{ __('message.whatsapp_link') }}</label>
                                                    <input type="text" class="form-control" id="whatsapp_link"
                                                        name="whatsapp_link" value="{{ $config->whatsapp_link }}">
                                                </div>
                                                @if ($errors->has('whatsapp_link'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('whatsapp_link') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <div
                                                    class="form-group {{ $errors->has('linkedin_link') ? ' has-danger' : '' }}">
                                                    <label for="linkedin_link">{{ __('message.linkedin_link') }}</label>
                                                    <input type="text" class="form-control" id="linkedin_link"
                                                        name="linkedin_link" value="{{ $config->linkedin_link }}">
                                                </div>
                                                @if ($errors->has('linkedin_link'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('linkedin_link') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <div
                                                    class="form-group {{ $errors->has('telegram_link') ? ' has-danger' : '' }}">
                                                    <label for="telegram_link">{{ __('message.telegram_link') }}</label>
                                                    <input type="text" class="form-control" id="telegram_link"
                                                        name="telegram_link" value="{{ $config->telegram_link }}">
                                                </div>
                                                @if ($errors->has('telegram_link'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('telegram_link') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <div
                                                    class="form-group {{ $errors->has('website_link') ? ' has-danger' : '' }}">
                                                    <label for="website_link">{{ __('message.website_link') }}</label>
                                                    <input type="text" class="form-control" id="website_link"
                                                        name="website_link" value="{{ $config->website_link }}">
                                                </div>
                                                @if ($errors->has('website_link'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('website_link') }}</strong>
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