@extends('provider.layouts.app')
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
            <form action="{{ route('provider.profileStore') }}" method="POST" enctype="multipart/form-data">
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
                                                <div
                                                    class="form-group {{ $errors->has('name_of_school_arabic') ? ' has-danger' : '' }}">
                                                    <label for="name_of_school_arabic">{{ __('message.Name Of School in Arabic') }}</label>
                                                    <input type="text" class="form-control" id="name_of_school_arabic"
                                                        name="name_of_school_arabic" value="{{ $user->name_arabic }}" required
                                                        autofocus>
                                                </div>
                                                @if ($errors->has('name_of_school_arabic'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('name_of_school_arabic') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group {{ $errors->has('name_of_school_english') ? ' has-danger' : '' }}">
                                                    <label for="name_of_school_english">{{ __('message.Name Of School in English') }}</label>
                                                    <input type="text" class="form-control" id="name_of_school_english" name="name_of_school_english"
                                                        value="{{ $user->name_english }}" required autofocus>
                                                </div>
                                                @if ($errors->has('name_of_school_english'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('name_of_school_english') }}</strong>
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
                                            <div class="form-group{{ $errors->has('educational_department_id') ? ' has-danger' : '' }} mb-3 col-md-6">
                                                <label for="educational_department_id" class="form-label">
                                                    {{ __('message.Educational Department') }}
                                                </label>
                                                <select class="form-control{{ $errors->has('educational_department_id') ? ' is-invalid' : '' }}"
                                                    name="educational_department_id[]" id="educational_department_id" multiple required>
                                                    @foreach($educationDepartments as $educational_department)
                                                        <option value="{{ $educational_department->id }}" {{ in_array($educational_department->id, $educationDepartmentOfUser->pluck('id')->toArray()) ? 'selected' : '' }}>
                                                            @if(app()->getLocale() == 'ar')
                                                                {{ $educational_department->name_arabic }}
                                                            @else
                                                                {{ $educational_department->name_english }}
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


                                            <div class="col-md-6">
                                                <div class="form-group {{ $errors->has('address') ? ' has-danger' : '' }}">
                                                    <label for="address">{{ __('message.Address') }}</label>
                                                    <input type="text" class="form-control" id="address" name="address"
                                                        value="{{ $user->address }}" required>
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
                                                        value="{{ $user->whatsapp }}">
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
                                                        value="{{ $user->facebook }}">
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
                                                        value="{{ $user->instagram }}">
                                                </div>
                                                @if ($errors->has('instagram'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('instagram') }}</strong>
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