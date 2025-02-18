@extends('provider.layouts.app')
@section('title', 'Add Attachment')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">{{ __('message.Add Attachment') }}</h3>
                    <h6 class="op-7 mb-2">4P</h6>
                </div>
            </div>
            <form action="{{ route('provider.attachments.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <!-- Name Input -->
                                            <div class="col-md-6">
                                                <div class="form-group {{ $errors->has('name') ? ' has-danger' : '' }}">
                                                    <label for="name">{{ __('message.Name') }}</label>
                                                    <input type="text" class="form-control" id="name" name="name" required>
                                                </div>
                                                @if ($errors->has('name'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <!-- Type Input -->
                                            <div class="col-md-6">
                                                <div class="form-group {{ $errors->has('type') ? ' has-danger' : '' }}">
                                                    <label for="type">{{ __('message.Type') }}</label>
                                                    <select class="form-control" name="type" id="type" required>
                                                        <option value="video">{{ __('message.Video') }}</option>
                                                        <option value="audio">{{ __('message.Audio') }}</option>
                                                        <option value="pdf">{{ __('message.PDF') }}</option>
                                                    </select>
                                                </div>
                                                @if ($errors->has('type'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('type') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <!-- URL or File Upload -->
                                            <div class="col-md-6">
                                                <div class="form-group {{ $errors->has('file') ? ' has-danger' : '' }}">
                                                    <label for="url">{{ __('message.File') }}</label>
                                                    <input type="file" class="form-control" id="file" name="file" required>
                                                </div>
                                                @if ($errors->has('file'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('file') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <!-- Sort Order Input -->
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

                                            <!-- Lesson Selection -->
                                            <div class="col-md-12">
                                                <div
                                                    class="form-group {{ $errors->has('lesson_id') ? ' has-danger' : '' }}">
                                                    <label for="lesson_id">{{ __('message.Lesson') }}</label>
                                                    <select class="form-control" name="lesson_id" id="lesson_id" required>
                                                        @foreach($lessons as $lesson)
                                                            <option value="{{ $lesson->id }}">
                                                                @if (app()->getLocale() == 'ar')
                                                                    {{ __('message.Lesson') }}: {{ $lesson->name }} |
                                                                    {{ __('message.Unit') }}: {{ $lesson->unit->name_arabic }} |
                                                                    {{  __('message.Class Room') }}:
                                                                    {{ $lesson->unit->classRoom->name_arabic }} |
                                                                    {{ __('message.Education Department') }}:
                                                                    {{ $lesson->unit->classRoom->educationDepartment->name_arabic }}
                                                                @else
                                                                    {{ __('message.Lesson') }}: {{ $lesson->name }} |
                                                                    {{ __('message.Unit') }}: {{ $lesson->unit->name_english }} |
                                                                    {{  __('message.Class Room') }}:
                                                                    {{ $lesson->unit->classRoom->name_english }} |
                                                                    {{ __('message.Education Department') }}:
                                                                    {{ $lesson->unit->classRoom->educationDepartment->name_english }}
                                                                @endif
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @if ($errors->has('lesson_id'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('lesson_id') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <!-- Submit Button -->
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