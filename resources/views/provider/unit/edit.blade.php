@extends('provider.layouts.app')
@section('title', 'Add Unit')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">{{ __('message.Add Unit') }}</h3>
                    <h6 class="op-7 mb-2">4P</h6>
                </div>
            </div>
            <form action="{{ route('provider.units.update', $unit->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('name_arabic') ? ' has-danger' : '' }}">
                                            <label for="name_arabic">{{ __('message.Name Arabic') }}</label>
                                            <input type="text" class="form-control" id="name_arabic" name="name_arabic"
                                                value="{{ $unit->name_arabic }}" required>
                                        </div>
                                        @if ($errors->has('name_arabic'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('name_arabic') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('name_english') ? ' has-danger' : '' }}">
                                            <label for="name_english">{{ __('message.Name English') }}</label>
                                            <input type="text" class="form-control" id="name_english" name="name_english"
                                                value="{{ $unit->name_english }}" required>
                                        </div>
                                        @if ($errors->has('name_english'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('name_english') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group {{ $errors->has('description') ? ' has-danger' : '' }}">
                                            <label for="description">{{ __('message.Description') }}</label>
                                            <textarea class="form-control" id="description" name="description" rows="3"
                                                required>{{ $unit->description }}</textarea>
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
                                        <div class="form-group {{ $errors->has('sort_order') ? ' has-danger' : '' }}">
                                            <label for="sort_order">{{ __('message.Sort Order') }}</label>
                                            <input type="number" class="form-control" id="sort_order" name="sort_order"
                                                min="0" value="{{ $unit->sort_order }}" required>
                                        </div>
                                        @if ($errors->has('sort_order'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('sort_order') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group {{ $errors->has('class_room_id') ? ' has-danger' : '' }}">
                                            <label for="class_room_id">{{ __('message.Class Room') }}</label>
                                            <select
                                                class="form-control {{ $errors->has('class_room_id') ? ' is-invalid' : '' }}"
                                                name="class_room_id" id="class_room_id" required>
                                                @foreach ($classRooms as $classRoom)
                                                    <option value="{{ $classRoom->id }}" {{ $classRoom->id == $unit->class_room_id ? 'selected' : ''}}>
                                                        @if (app()->getLocale() == 'ar')
                                                            {{ $classRoom->name_arabic }} |
                                                            {{ $classRoom->educationDepartment->name_arabic }}
                                                        @else
                                                            {{ $classRoom->name_english }} |
                                                            {{ $classRoom->educationDepartment->name_english }}
                                                        @endif
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @if ($errors->has('class_room_id'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('class_room_id') }}</strong>
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
            </form>
        </div>
    </div>
@endsection