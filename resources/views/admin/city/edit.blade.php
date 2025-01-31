@extends('admin.layouts.app')
@section('title', 'City')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">{{ __('message.Cities') }}</h3>
                <h6 class="op-7 mb-2">4P</h6>
            </div>
            {{-- <div class="ms-md-auto">
                <a href="{{ route('admin.cities.edit', $city->id) }}"
                    class="btn btn-secondary btn-round">{{ __('message.Edit') }}</a>
            </div> --}}
        </div>
        <form action="{{ route('admin.cities.update', $city->id) }}" method="POST">
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
                                            <div class="form-group
                                                {{ $errors->has('name_arabic') ? ' has-danger' : '' }}">
                                                <label for="name_arabic">{{ __('message.Name Arabic') }}</label>
                                                <input type="text" class="form-control" id="name_arabic" name="name_arabic"
                                                    value="{{ $city->name_arabic }}" required>
                                            </div>
                                            @if ($errors->has('name_arabic'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('name_arabic') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group
                                                {{ $errors->has('name_english') ? ' has-danger' : '' }}">
                                                <label for="name_english">{{ __('message.Name English') }}</label>
                                                <input type="text" class="form-control" id="name_english" name="name_english" 
                                                value="{{ $city->name_english }}" required>
                                            </div>
                                            @if ($errors->has('name_english'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('name_english') }}</strong>
                                                </span>
                                            @endif
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
@endsection