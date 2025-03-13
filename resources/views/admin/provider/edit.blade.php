@extends('admin.layouts.app')
@section('title', 'Edit Provider')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">{{ __('message.Edit Provider') }}</h3>
                    <h6 class="op-7 mb-2">4P</h6>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <form method="POST" action="{{ route('admin.providers.update', $provider->id) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div
                                            class="form-group{{ $errors->has('name') ? ' has-danger' : '' }} mb-3 col-md-6">
                                            <div class="input-group input-group-alternative">
                                                <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                    placeholder="{{ __('message.Name') }}" type="text" name="name"
                                                    value="{{ $provider->user->name }}" required autofocus>
                                            </div>
                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div
                                            class="form-group{{ $errors->has('email') ? ' has-danger' : '' }} mb-3 col-md-6">
                                            <div class="input-group input-group-alternative">
                                                <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                    placeholder="{{ __('message.Email') }}" type="email" name="email"
                                                    value="{{ $provider->user->email }}" required autofocus>
                                            </div>
                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div
                                            class="form-group{{ $errors->has('phone') ? ' has-danger' : '' }} mb-3 col-md-6">
                                            <div class="input-group input-group-alternative">
                                                <input class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
                                                    placeholder="{{ __('message.Phone') }}" type="text" name="phone"
                                                    value="{{ $provider->user->phone }}" required autofocus>
                                            </div>
                                            @if ($errors->has('phone'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div
                                            class="form-group{{ $errors->has('image') ? ' has-danger' : '' }} mb-3 col-md-6">
                                            <div class="input-group input-group-alternative">
                                                <input class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}"
                                                    placeholder="{{ __('message.Image') }}" type="file" name="image"
                                                    value="{{ old('image') }}">
                                            </div>
                                            @if ($errors->has('image'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('image') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group @error('password') has-danger @enderror mb-3 col-md-6">
                                            <div class="input-group input-group-alternative">
                                                <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                                                    placeholder="{{ __('message.Password') }}" type="password" id="password">
                                                <i id="eye-icon" class="fa fa-eye position-absolute"
                                                    style="right: 20px; top: 50%; transform: translateY(-50%); cursor: pointer; z-index: 10;"
                                                    onclick="togglePassword()"></i>
                                            </div>
                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div
                                            class="form-group{{ $errors->has('password_confirmation') ? ' has-danger' : '' }} mb-3 col-md-6">
                                            <div class="input-group input-group-alternative">
                                                <input
                                                    class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                                                    placeholder="{{ __('message.Confirm Password') }}" type="password"
                                                    name="password_confirmation" value="{{ old('password_confirmation') }}">
                                            </div>
                                            @if ($errors->has('password_confirmation'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div
                                            class="form-group{{ $errors->has('name_of_school_arabic') ? ' has-danger' : '' }} mb-3 col-md-6">
                                            <div class="input-group input-group-alternative">
                                                <input
                                                    class="form-control{{ $errors->has('name_of_school_arabic') ? ' is-invalid' : '' }}"
                                                    placeholder="{{ __('message.Name Of School in Arabic') }}" type="text"
                                                    name="name_of_school_arabic" value="{{ $provider->name_arabic }}"
                                                    required>
                                            </div>
                                            @if ($errors->has('name_of_school_arabic'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('name_of_school_arabic') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div
                                            class="form-group{{ $errors->has('name_of_school_english') ? ' has-danger' : '' }} mb-3 col-md-6">
                                            <div class="input-group input-group-alternative">
                                                <input
                                                    class="form-control{{ $errors->has('name_of_school_english') ? ' is-invalid' : '' }}"
                                                    placeholder="{{ __('message.Name Of School in English') }}" type="text"
                                                    name="name_of_school_english"
                                                    value="{{ $provider->name_english }}" required>
                                            </div>
                                            @if ($errors->has('name_of_school_english'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('name_of_school_english') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div
                                            class="form-group{{ $errors->has('logo') ? ' has-danger' : '' }} mb-3 col-md-6">
                                            <div class="input-group input-group-alternative">
                                                <label for="image" class="input-group">{{ __('message.Logo') }}</label>
                                                <input class="form-control{{ $errors->has('logo') ? ' is-invalid' : '' }}"
                                                    placeholder="{{ __('message.Logo') }}" type="file" name="logo"
                                                    value="{{ old('logo') }}">
                                            </div>
                                            @if ($errors->has('logo'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('logo') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div
                                            class="form-group{{ $errors->has('educational_department_id') ? ' has-danger' : '' }} mb-3 col-md-6">
                                            <label for="educational_department_id" class="form-label">
                                                {{ __('message.Educational Department') }}
                                            </label>
                                            <select
                                                class="form-control{{ $errors->has('educational_department_id') ? ' is-invalid' : '' }}"
                                                name="educational_department_id[]" id="educational_department_id" multiple
                                                required>
                                                @foreach($educationDepartments as $educationDepartment)
                                                    <option value="{{ $educationDepartment->id }}" {{ in_array($educationDepartment->id, $provider->educationDepartments->pluck('id')->toArray()) ? 'selected' : '' }}>
                                                        @if(app()->getLocale() == 'ar')
                                                            {{ $educationDepartment->name_arabic }}
                                                        @else
                                                            {{ $educationDepartment->name_english }}
                                                        @endif
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('educational_department_id'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('educational_department_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div
                                            class="form-group{{ $errors->has('address') ? ' has-danger' : '' }} mb-3 col-md-6">
                                            <div class="input-group input-group-alternative">
                                                <input
                                                    class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}"
                                                    placeholder="{{ __('message.Address') }}" type="text" name="address"
                                                    value="{{ $provider->address }}">
                                            </div>
                                            @if ($errors->has('address'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('address') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div
                                            class="form-group{{ $errors->has('whatsapp') ? ' has-danger' : '' }} mb-3 col-md-6">
                                            <div class="input-group input-group-alternative">
                                                <input
                                                    class="form-control{{ $errors->has('whatsapp') ? ' is-invalid' : '' }}"
                                                    placeholder="{{ __('message.Whatsapp') }}" type="text" name="whatsapp"
                                                    value="{{ $provider->whatsapp }}">
                                            </div>
                                            @if ($errors->has('whatsapp'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('whatsapp') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div
                                            class="form-group{{ $errors->has('facebook') ? ' has-danger' : '' }} mb-3 col-md-6">
                                            <div class="input-group input-group-alternative">
                                                <input
                                                    class="form-control{{ $errors->has('facebook') ? ' is-invalid' : '' }}"
                                                    placeholder="{{ __('message.Facebook') }}" type="text" name="facebook"
                                                    value="{{ $provider->facebook }}">
                                            </div>
                                            @if ($errors->has('facebook'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('facebook') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div
                                            class="form-group{{ $errors->has('instagram') ? ' has-danger' : '' }} mb-3 col-md-6">
                                            <div class="input-group input-group-alternative">
                                                <input
                                                    class="form-control{{ $errors->has('instagram') ? ' is-invalid' : '' }}"
                                                    placeholder="{{ __('message.Instagram') }}" type="text" name="instagram"
                                                    value="{{ $provider->instagram }}">
                                            </div>
                                            @if ($errors->has('instagram'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('instagram') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <div
                                                class="form-group {{ $errors->has('account_status') ? ' has-danger' : '' }}">
                                                <label for="account_status">{{ __('message.Status of Account') }}</label>
                                                <select class="form-control" id="account_status" name="account_status"
                                                    required>
                                                    <option value="active" {{ $provider->user->status == 'active' ? 'selected' : '' }}>{{ __('message.Active') }}
                                                    </option>
                                                    <option value="inactive" {{ $provider->user->status == 'inactive' ? 'selected' : '' }}>
                                                        {{ __('message.Inactive') }}
                                                    </option>
                                                </select>
                                            </div>
                                            @if ($errors->has('account_status'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('account_status') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <div
                                                class="form-group {{ $errors->has('provider_status') ? ' has-danger' : '' }}">
                                                <label for="provider_status">{{ __('message.Status of Provider') }}</label>
                                                <select class="form-control" id="provider_status" name="provider_status"
                                                    required>
                                                    <option value="pending" {{ $provider->status == 'pending' ? 'selected' : '' }}>{{ __('message.Pending') }}
                                                    </option>
                                                    <option value="accepted" {{ $provider->status == 'accepted' ? 'selected' : '' }}>
                                                        {{ __('message.Accepted') }}
                                                    </option>
                                                    <option value="rejected" {{ $provider->status == 'rejected' ? 'selected' : '' }}>
                                                        {{ __('message.Rejected') }}
                                                    </option>
                                                </select>
                                            </div>
                                            @if ($errors->has('provider_status'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('provider_status') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="">
                                            <button type="submit" class="btn btn my-4"
                                                style="background-color: #BD3628; color: white;">{{ __('message.Edit') }}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#educational_department_id').select2({
                placeholder: "{{ __('message.Educational Department') }}",
                allowClear: true,
                multiple: true,
                minimumResultsForSearch: Infinity,
                closeOnSelect: false
            });
        });
    </script>
@endsection