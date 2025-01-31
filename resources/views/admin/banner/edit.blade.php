@extends('admin.layouts.app')
@section('title', 'Edit Banner')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">{{ __('message.Edit Banner') }}</h3>
                <h6 class="op-7 mb-2">4P</h6>
            </div>
        </div>
        <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
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
                                                <input type="text" class="form-control" id="name_arabic"
                                                    name="name_arabic" value="{{ $banner->name_arabic }}" required>
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
                                                <input type="text" class="form-control" id="name_english"
                                                    name="name_english" value="{{ $banner->name_english }}" required>
                                            </div>
                                            @if ($errors->has('name_english'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('name_english') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group {{ $errors->has('image') ? ' has-danger' : '' }}">
                                                <label for="image">{{ __('message.Image') }}</label>
                                                <input type="file" class="form-control" id="image" name="image">
                                            </div>
                                            @if ($errors->has('image'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('image') }}</strong>
                                                </span>
                                            @endif
                                            <div class="col-md-6">
                                                <div class="form-group">
                                            <img src="{{ asset($banner->image) }}" alt="{{ $banner->name_english }}" width="70px" height="70px"
                                                style="border-radius: 5px; display: inline;">
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
@endsection