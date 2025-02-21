@extends('admin.layouts.app')
@section('title', 'Edit User')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">{{ __('message.Edit User') }}</h3>
                    <h6 class="op-7 mb-2">4P</h6>
                </div>
            </div>
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12">
                        @if(!$user->code)
                            <div class="form-group d-flex justify-content-end">
                                <button type="button" class="btn" id="addCode"
                                    style="background-color: white; color: #BC3726; border: 1px solid #BC3726;"
                                    onmouseover="this.style.backgroundColor='#BC3726'; this.style.color='#F5F7FD';"
                                    onmouseout="this.style.backgroundColor='white'; this.style.color='#BC3726';" data-bs-toggle="modal"
                                    data-bs-target="#addCodeModal">
                                    {{ __('message.Add Code') }}
                                </button>
                            </div>
                        @endif
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="avatar avatar-xl">
                                            <img src="{{ asset($user->image) }}" alt="..."
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
                                                        value="{{ $user->name }}" required>
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
                                                        value="{{$user->email }}">
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
                                                        value="{{ $user->phone }}" required>
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
                                                <div class="form-group {{ $errors->has('password') ? ' has-danger' : '' }}">
                                                    <label for="password">{{ __('message.Password') }}</label>
                                                    <input type="password" class="form-control" id="password"
                                                        name="password">
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
                                                <div class="form-group {{ $errors->has('city_id') ? ' has-danger' : '' }}">
                                                    <label for="city_id">{{ __('message.City') }}</label>
                                                    <select class="form-control" id="city_id" name="city_id" required>
                                                        <option value="">{{ __('message.Select City') }}</option>
                                                        @foreach($cities as $city)
                                                            <option value="{{ $city->id }}" {{ $user->city_id == $city->id ? 'selected' : ' '}}>
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
                                            <div class="col-md-6">
                                                <div class="form-group {{ $errors->has('status') ? ' has-danger' : '' }}">
                                                    <label for="status">{{ __('message.Status') }}</label>
                                                    <select class="form-control" id="status" name="status" required>
                                                        <option value="">{{ __('message.Select Status') }}</option>
                                                        <option value="active" {{ $user->status == 'active' ? 'selected' : ' '}}>{{ __('message.Active') }}</option>
                                                        <option value="inactive" {{ $user->status == 'inactive' ? 'selected' : ' '}}>{{ __('message.Inactive') }}</option>
                                                    </select>
                                                </div>
                                                @if ($errors->has('status'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('status') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="modal fade" id="addCodeModal" tabindex="-1" aria-labelledby="addCodeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="addCodeModalLabel">
                                                                {{ __('message.Add Code') }}
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label>
                                                                    <input type="checkbox" id="oneYearCheckbox" name="one_year" value="1">
                                                                    {{ __('message.Valid for 1 Year') }}
                                                                </label>
                                                            </div>
                                                            <div id="dateFields" style="display: block;">
                                                                <div class="form-group">
                                                                    <label for="start_date">{{ __('message.Start Date') }}</label>
                                                                    <input type="date" class="form-control" id="start_date" name="start_date">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="end_date">{{ __('message.End Date') }}</label>
                                                                    <input type="date" class="form-control" id="end_date" name="end_date">
                                                                </div>
                                                            </div>
                                                            <div id="validationError" class="alert alert-danger mt-3" style="display: none;">
                                                                {{ __('message.Please select an option') }}
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" id="checkCodes">{{ __('message.Add') }}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if($user->code)
                                                <div class="col-md-12">
                                                    <div class="form-group {{ $errors->has('code') ? ' has-danger' : '' }}">
                                                        <label for="code">{{ __('message.Code') }}</label>
                                                        <div class="d-flex align-items-center">
                                                            <input type="text" class="form-control me-2" id="code" name="code"
                                                                value="{{ $user->code->code }} | {{ $user->code->start_date }} | {{ $user->code->end_date }}"
                                                                disabled>

                                                            {{-- زر التعديل --}}
                                                            <!-- زر فتح النافذة المنبثقة -->
                                                            <button type="button" class="btn btn-link btn-primary btn-lg"
                                                                data-bs-toggle="modal" data-bs-target="#editCodeModal"
                                                                id="editcode"
                                                                onclick="loadCodeData('{{ $user->code->start_date }}', '{{ $user->code->end_date }}')">
                                                                <i class="fa fa-edit"></i>
                                                            </button>

                                                            {{-- زر الحذف --}}
                                                            <button type="button" data-bs-toggle="tooltip"
                                                                title="{{ __('message.Remove') }}"
                                                                class="btn btn-link btn-danger"
                                                                onclick="confirmDelete(this, '{{ $user->code->id }}')">
                                                                <i class="fa fa-times"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>

                                            @endif                                          <!-- Modal نافذة تعديل الكود -->
                                            <div class="modal fade" id="editCodeModal" tabindex="-1"
                                                aria-labelledby="editCodeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editCodeModalLabel">
                                                                {{ __('message.Edit Code') }}
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="editCodeForm">
                                                                <div class="form-group">
                                                                    <label
                                                                        for="edit_start_date">{{ __('message.Start Date') }}</label>
                                                                    <input type="date" class="form-control"
                                                                        id="edit_start_date" name="start_date">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label
                                                                        for="edit_end_date">{{ __('message.End Date') }}</label>
                                                                    <input type="date" class="form-control"
                                                                        id="edit_end_date" name="end_date">
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn text-white" style="background-color: gray"
                                                                data-bs-dismiss="modal">{{ __('message.Close') }}</button>
                                                            <button type="button" class="btn btn-secondary"
                                                                onclick="saveCodeChanges({{ $user->id }})">
                                                                {{ __('message.Save Changes') }}
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
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
    @if($user->code)
        <script>
            // تحميل بيانات الكود إلى الـ modal عند فتحه
            function loadCodeData(startDate, endDate) {
                document.getElementById('edit_start_date').value = startDate || '';
                document.getElementById('edit_end_date').value = endDate || '';
            }

            // حفظ التعديلات باستخدام AJAX
            function saveCodeChanges(userId) {
                let startDate = document.getElementById('edit_start_date').value;
                let endDate = document.getElementById('edit_end_date').value;

                $.ajax({
                    url: "{{ route('admin.codes.update', $user->code->id) }}", // استبدلها بالمسار الفعلي
                    type: "PUT",
                    data: {
                        _token: "{{ csrf_token() }}",
                        user_id: userId,
                        start_date: startDate,
                        end_date: endDate
                    },
                    success: function (response) {
                        alert("{{__('message.Code Edit Successfully')}}");
                        console.log(response);
                        document.getElementById('code').value = response.code.code + ' | ' + response.code.start_date + ' | ' + response.code.end_date;
                        $('#editCodeModal').modal('hide'); // إغلاق النافذة
                    },
                    error: function () {
                        alert("حدث خطأ أثناء الاتصال بالخادم!");
                    }
                });
            }
        </script>
        <script>
            function confirmDelete(button, codeId) {
                if (confirm("{{__('message.Are You Sure')}}")) {
                    $.ajax({
                         url: "{{ route('admin.destroyAjax', '') }}/" + codeId,
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function (response) {
                            alert("{{__('message.Code Deleted Successfully')}}");
                            location.reload();
                        },
                        error: function () {
                            alert("حدث خطأ أثناء الحذف!");
                        }
                    });
                }
            }

        </script>
    @endif
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