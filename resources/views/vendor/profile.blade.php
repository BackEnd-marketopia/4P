@extends('vendor.layouts.app')
@section('title', 'Profile')
@section('content')
<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">{{ __('message.Edit Profile') }}</h3>
                <h6 class="op-7 mb-2">4P</h6>
            </div>
        </div>
        <form action="{{ route('vendor.profileSotre') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                {{-- <div class="col-md-3">
                                    <div class="avatar avatar-xl">
                                        <img src="{{ asset(auth('web')->user()->image) }}" alt="..."
                                            class="avatar-img rounded-circle">
                                    </div>
                                </div> --}}
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('cover') ? ' has-danger' : '' }}">
                                                <label for="cover">{{ __('message.Cover') }}</label>
                                                <input type="file" class="form-control" id="cover" name="cover">
                                            </div>
                                            @if ($errors->has('cover'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('cover') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('logo') ? ' has-danger' : '' }}">
                                                <label for="logo">{{ __('message.Logo') }}</label>
                                                <input type="file" class="form-control" id="logo" name="logo">
                                            </div>
                                            @if ($errors->has('logo'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('logo') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-md-12">
                                            <div
                                                class="form-group {{ $errors->has('description') ? ' has-danger' : '' }}">
                                                <label for="description">{{ __('message.Description') }}</label>
                                                <textarea class="form-control" id="description"
                                                    name="description">{{ $user->vendor->description }}</textarea>
                                            </div>
                                            @if ($errors->has('description'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('description') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div
                                            class="form-group{{ $errors->has('category_id') ? ' has-danger' : '' }} mb-3 col-md-6">
                                            <label for="categories"
                                                class="form-label">{{ __('message.Categories') }}</label>
                                            <select
                                                class="form-control{{ $errors->has('category_id') ? ' is-invalid' : '' }}"
                                                name="category_id" id="category_id" required>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ $user->vendor->category_id == $category->id ? 'selected' : ' '}}>
                                                        @if(app()->getLocale() == 'ar')
                                                            {{ $category->name_arabic }}
                                                        @else
                                                            {{ $category->name_english }}
                                                        @endif
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('category_id'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('category_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div
                                            class="form-group{{ $errors->has('city_ids') ? ' has-danger' : '' }} mb-3 col-md-6">
                                            <label for="city_ids" class="form-label">{{ __('message.Cities') }}</label>
                                            <select
                                                class="form-control{{ $errors->has('city_ids') ? ' is-invalid' : '' }}"
                                                name="city_ids[]" id="city_ids" multiple required>
                                                @php
                                                    $cities_id = json_decode($user->vendor->citys_id, true);

                                                @endphp
                                                @foreach($cities as $city)
                                                    <option value="{{ $city->id }}" {{ in_array((string) $city->id, $cities_id) ? 'selected' : '' }}>
                                                        @if(app()->getLocale() == 'ar')
                                                            {{ $city->name_arabic }}
                                                        @else
                                                            {{ $city->name_english }}
                                                        @endif
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('city_ids'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('city_ids') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('address') ? ' has-danger' : '' }}">
                                                <label for="address">{{ __('message.Address') }}</label>
                                                <input type="text" class="form-control" id="address" name="address"
                                                    value="{{ $user->vendor->address }}" required>
                                            </div>
                                            @if ($errors->has('address'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('address') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('whatsapp') ? ' has-danger' : '' }}">
                                                <label for="whatsapp">{{ __('message.Whatsapp') }}</label>
                                                <input type="text" class="form-control" id="whatsapp" name="whatsapp"
                                                    value="{{ $user->vendor->whatsapp }}">
                                            </div>
                                            @if ($errors->has('whatsapp'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('whatsapp') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('facebook') ? ' has-danger' : '' }}">
                                                <label for="facebook">{{ __('message.Facebook') }}</label>
                                                <input type="text" class="form-control" id="facebook" name="facebook"
                                                    value="{{ $user->vendor->facebook }}">
                                            </div>
                                            @if ($errors->has('facebook'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('facebook') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <div
                                                class="form-group {{ $errors->has('instagram') ? ' has-danger' : '' }}">
                                                <label for="instagram">{{ __('message.Instagram') }}</label>
                                                <input type="text" class="form-control" id="instagram" name="instagram"
                                                    value="{{ $user->vendor->instagram }}">
                                            </div>
                                            @if ($errors->has('instagram'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('instagram') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-md-12">
                                            <div
                                                class="form-group {{ $errors->has('google_map_link') ? ' has-danger' : '' }}">
                                                <label for="latitude">{{ __('message.Google Map Link') }}</label>
                                                <input type="text" class="form-control" id="google_map_link"
                                                    name="google_map_link" value="{{ $user->vendor->google_map_link }}">
                                            </div>
                                            @if ($errors->has('google_map_link'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('google_map_link') }}</strong>
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