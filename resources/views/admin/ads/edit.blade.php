@extends('admin.layouts.app')
@section('title', 'Edit Advertisement')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">{{ __('message.Edit Advertisement') }}</h3>
                    <h6 class="op-7 mb-2">4P</h6>
                </div>
            </div>
            <form action="{{ route('admin.ads.update', $ads->id) }}" method="POST" enctype="multipart/form-data">
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
                                                                                                      {{ $errors->has('name') ? ' has-danger' : '' }}">
                                                    <label for="name">{{ __('message.Name Arabic') }}</label>
                                                    <input type="text" class="form-control" id="name" name="name"
                                                        value="{{ $ads->name }}" required>
                                                </div>
                                                @if ($errors->has('name'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('name') }}</strong>
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
                                                <div class="form-group {{ $errors->has('url') ? ' has-danger' : '' }}">
                                                    <label for="url">{{ __('message.Url') }}</label>
                                                    <input type="text" class="form-control" id="url" value="{{ $ads->url }}"
                                                        name="url">
                                                </div>
                                                @if ($errors->has('url'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('url') }}</strong>
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
                                                        $cities_id = json_decode($ads->city_id, true);
                                                        if (in_array('all', $cities_id)) {
                                                            $cities_id = ['all'];
                                                        }
                                                    @endphp
                                                    <option value="all" {{ in_array('all', $cities_id) ? 'selected' : ''  }}>
                                                        {{ __('message.All') }}
                                                    </option>
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
                                                <div
                                                    class="form-group {{ $errors->has('start_date') ? ' has-danger' : '' }}">
                                                    <label for="start_date">{{ __('message.Start Date') }}</label>
                                                    <input type="date" class="form-control" id="start_date"
                                                        name="start_date" value="{{ $ads->start_date }}">
                                                </div>
                                                @if ($errors->has('start_date'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('start_date') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group {{ $errors->has('end_date') ? ' has-danger' : '' }}">
                                                    <label for="end_date">{{ __('message.End Date') }}</label>
                                                    <input type="date" class="form-control" id="end_date" name="end_date"
                                                        value="{{ $ads->end_date }}">
                                                </div>
                                                @if ($errors->has('end_date'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('end_date') }}</strong>
                                                    </span>
                                                @endif
                                                <div class="col-md-12">
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
@endsection