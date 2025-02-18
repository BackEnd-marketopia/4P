@extends('provider.layouts.app')
@section('title', 'Add Class Room')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">{{ __('message.Add Class Room') }}</h3>
                    <h6 class="op-7 mb-2">4P</h6>
                </div>
            </div>
            <form action="{{ route('provider.class-rooms.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div
                                                    class="form-group {{ $errors->has('name_arabic') ? ' has-danger' : '' }}">
                                                    <label for="name_arabic">{{ __('message.Name Arabic') }}</label>
                                                    <input type="text" class="form-control" id="name_arabic"
                                                        name="name_arabic" required>
                                                </div>
                                                @if ($errors->has('name_arabic'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('name_arabic') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="col-md-6">
                                                <div
                                                    class="form-group {{ $errors->has('name_english') ? ' has-danger' : '' }}">
                                                    <label for="name_english">{{ __('message.Name English') }}</label>
                                                    <input type="text" class="form-control" id="name_english"
                                                        name="name_english" required>
                                                </div>
                                                @if ($errors->has('name_english'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('name_english') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group {{ $errors->has('image') ? ' has-danger' : '' }}">
                                                    <label for="image">{{ __('message.Image') }}</label>
                                                    <input type="file" class="form-control" id="image" name="image"
                                                        required>
                                                </div>
                                                @if ($errors->has('image'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('image') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="col-md-6">
                                                <div
                                                    class="form-group {{ $errors->has('sort_order') ? ' has-danger' : '' }}">
                                                    <label for="sort_order">{{ __('message.Sort Order') }}</label>
                                                    <input type="number" class="form-control" id="sort_order"
                                                        name="sort_order" min="0" required>
                                                </div>
                                                @if ($errors->has('sort_order'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('sort_order') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div
                                                class="form-group{{ $errors->has('education_department_id') ? ' has-danger' : '' }} mb-3 col-md-12">
                                                <label for="education_department_id" class="form-label">
                                                    {{ __('message.Educational Department') }}
                                                </label>
                                                <select
                                                    class="form-control{{ $errors->has('education_department_id') ? ' is-invalid' : '' }}"
                                                    name="education_department_id" id="education_department_id" required>
                                                    @foreach($educationDepartments as $educational_department)
                                                        <option value="{{ $educational_department->id }}">
                                                            @if(app()->getLocale() == 'ar')
                                                                {{ $educational_department->name_arabic }}
                                                            @else
                                                                {{ $educational_department->name_english }}
                                                            @endif
                                                        </option>
                                                    @endforeach
                                                </select>

                                                @if ($errors->has('education_department_id'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('education_department_id') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <button class="btn btn-secondary" type="submit">
                                                        {{ __('message.Add') }}
                                                    </button>
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