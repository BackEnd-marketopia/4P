@extends('admin.layouts.app')
@section('title', 'Add User')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">{{ __('message.Add User') }}</h3>
                    <h6 class="op-7 mb-2">4P</h6>
                </div>
            </div>
            <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <div class="form-group d-flex justify-content-end">
                                <button type="button" class="btn" id="addCode"
                                    style="background-color: white; color: #BC3726; border: 1px solid #BC3726;"
                                    onmouseover="this.style.backgroundColor='#BC3726'; this.style.color='#F5F7FD';"
                                    onmouseout="this.style.backgroundColor='white'; this.style.color='#BC3726';"
                                    data-bs-toggle="modal" data-bs-target="#addCodeModal">
                                    {{ __('message.Add Code') }}
                                </button>

                            </div>
                        </div>

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
                                                    class="form-group
                                                                                                                                                                                                                                    {{ $errors->has('name') ? ' has-danger' : '' }}">
                                                    <label for="name">{{ __('message.Name') }}</label>
                                                    <input type="text" class="form-control" id="name" name="name"
                                                        value="{{ old('name') }}" required>
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
                                                        value="{{ old('email') }}">
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
                                                        value="{{ old('phone') }}" required>
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
                                                <div class="form-group {{ $errors->has('password') ? ' has-danger' : '' }} position-relative">
                                                    <label for="password">{{ __('message.Password') }}</label>
                                                    <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" id="password"
                                                        name="password">
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
                                            <div class="col-md-12">
                                                <div class="form-group {{ $errors->has('city_id') ? ' has-danger' : '' }}">
                                                    <label for="city_id">{{ __('message.City') }}</label>
                                                    <select class="form-control" id="city_id" name="city_id" required>
                                                        <option value="">{{ __('message.Select City') }}</option>
                                                        @foreach($cities as $city)
                                                            <option value="{{ $city->id }}">
                                                                @if(app()->getLocale() == 'ar')
                                                                    {{ $city->name_arabic }}
                                                                @else
                                                                    {{ $city->name_english }}
                                                                @endif
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @if ($errors->has('city_id'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('city_id') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <!-- Code Generation Modal -->
                                            <div class="modal fade" id="addCodeModal" tabindex="-1"
                                                aria-labelledby="addCodeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="addCodeModalLabel">
                                                                {{ __('message.Add Code') }}
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label>
                                                                    <input type="checkbox" id="oneYearCheckbox"
                                                                        name="one_year" value="1">
                                                                    {{ __('message.Valid for 1 Year') }}
                                                                </label>
                                                            </div>
                                                            <div id="dateFields" style="display: block;">
                                                                <div class="form-group">
                                                                    <label
                                                                        for="start_date">{{ __('message.Start Date') }}</label>
                                                                    <input type="date" class="form-control" id="start_date"
                                                                        name="start_date">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label
                                                                        for="end_date">{{ __('message.End Date') }}</label>
                                                                    <input type="date" class="form-control" id="end_date"
                                                                        name="end_date">
                                                                </div>
                                                            </div>
                                                            <div id="validationError" class="alert alert-danger mt-3"
                                                                style="display: none;">
                                                                {{ __('message.Please select an option') }}
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                id="checkCodes">{{ __('message.Add') }}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <button class="btn btn-secondary"
                                                        type="submit">{{ __('message.Add') }}</button>
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
        document.getElementById('oneYearCheckbox').addEventListener('change', function () {
            const dateFields = document.getElementById('dateFields');
            if (this.checked) {
                dateFields.style.display = 'none';
            } else {
                dateFields.style.display = 'block';
            }
        });
    </script>
    <script>
        function isAnyOptionSelected() {
            return document.getElementById("oneYearCheckbox").checked || document.getElementById("start_date").value || document.getElementById("end_date").value;
        }
        function updateButtonText() {
            if (isAnyOptionSelected()) {
                addCodeButton.textContent = "{{ __('message.Edit Code') }}";
            } else {
                addCodeButton.textContent = "{{ __('message.Add Code') }}";
            }
        }
        $(document).ready(function () {
            $('#checkCodes').click(function () {
                if (!isAnyOptionSelected()) {
                    validationError.style.display = "block";
                    return;
                } else {
                    validationError.style.display = "none";
                }
                $.ajax({
                    url: "{{ route('admin.check.codes') }}",
                    type: "GET",
                    success: function (response) {
                        if (response.has_codes) {
                            document.getElementById('addCode').innerHTML = "{{ __('message.Edit Code') }}";
                            $('#addCodeModal').modal('hide');
                        } else {
                            if ($('#codeError').length === 0) {
                                $(".modal-body").append('<div id="codeError" class="alert alert-danger mt-3">{{ __('message.You do not have any codes') }}</div>');
                            }
                        }
                    },
                    error: function () {
                        alert("An error occurred. Please try again.");
                    }
                });
            });
        });
    </script>
@endsection