@extends('provider.layouts.app')
@section('title', 'Edit Lesson')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">{{ __('message.Edit Lesson') }}</h3>
                    <h6 class="op-7 mb-2">4P</h6>
                </div>
            </div>
            <form action="{{ route('provider.lessons.update', $lesson->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group {{ $errors->has('name') ? ' has-danger' : '' }}">
                                                    <label for="name">{{ __('message.Name') }}</label>
                                                    <input type="text" class="form-control" id="name" name="name"
                                                        value="{{ $lesson->name }}" required>
                                                </div>
                                                @if ($errors->has('name'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="col-md-12">
                                                <div
                                                    class="form-group {{ $errors->has('description') ? ' has-danger' : '' }}">
                                                    <label for="description">{{ __('message.Description') }}</label>
                                                    <textarea class="form-control" id="description" name="description"
                                                        rows="4" required>{{ $lesson->description }}</textarea>
                                                </div>
                                                @if ($errors->has('description'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('description') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group {{ $errors->has('image') ? ' has-danger' : '' }}">
                                                    <label for="image">{{ __('message.Image') }}</label>
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
                                                    class="form-group {{ $errors->has('sort_order') ? ' has-danger' : '' }}">
                                                    <label for="sort_order">{{ __('message.Sort Order') }}</label>
                                                    <input type="number" class="form-control" id="sort_order"
                                                        name="sort_order" min="0" value="{{ $lesson->sort_order }}"
                                                        required>
                                                </div>
                                                @if ($errors->has('sort_order'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('sort_order') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group {{ $errors->has('unit_id') ? ' has-danger' : '' }}">
                                                    <label for="unit_id">{{ __('message.Unit') }}</label>
                                                    <select
                                                        class="form-control{{ $errors->has('unit_id') ? ' is-invalid' : '' }}"
                                                        name="unit_id" id="unit_id" required>
                                                        @foreach($units as $unit)
                                                            <option value="{{ $unit->id }}" {{ $unit->id == $lesson->unit->id ? 'selected' : ''}}>
                                                                @if (app()->getLocale() == 'ar')
                                                                    {{ __('message.Unit') }}: {{ $unit->name_arabic }} |
                                                                    {{  __('message.Class Room') }}:
                                                                    {{ $unit->classRoom->name_arabic }} |
                                                                    {{ __('message.Education Department') }}:
                                                                    {{ $unit->classRoom->educationDepartment->name_arabic }}
                                                                @else
                                                                    {{ __('message.Unit') }}: {{ $unit->name_english }} |
                                                                    {{  __('message.Class Room') }}:
                                                                    {{ $unit->classRoom->name_english }} |
                                                                    {{ __('message.Education Department') }}:
                                                                    {{ $unit->classRoom->educationDepartment->name_english }}
                                                                @endif
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @if ($errors->has('unit_id'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('unit_id') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <button class="btn btn-secondary" type="submit">
                                                        {{ __('message.Edit') }}
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