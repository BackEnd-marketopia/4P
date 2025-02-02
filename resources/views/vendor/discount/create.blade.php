@extends('vendor.layouts.app')
@section('title', 'Add Discount')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">{{ __('message.Add Discount') }}</h3>
                <h6 class="op-7 mb-2">4P</h6>
            </div>
            {{-- <div class="ms-md-auto">
                <a href="{{ route('admin.profileMe') }}" class="btn btn-secondary btn-round">{{ __('message.Edit
                    Profile') }}</a>
            </div> --}}
        </div>
        <form action="{{ route('vendor.discounts.store') }}" method="POST" enctype="multipart/form-data">
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
                                        <div class="col-md-12">
                                            <div class="form-group
                                                {{ $errors->has('title') ? ' has-danger' : '' }}">
                                                <label for="title">{{ __('message.Title') }}</label>
                                                <input type="text" class="form-control" id="title" name="title" required>
                                            </div>
                                            @if ($errors->has('title'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('title') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group {{ $errors->has('description') ? ' has-danger' : '' }}">
                                                <label for="description">{{ __('message.Description') }}</label>
                                                <textarea class="form-control" id="description" name="description" required></textarea>
                                            </div>
                                            @if ($errors->has('description'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('description') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group {{ $errors->has('start_date') ? ' has-danger' : '' }}">
                                                <label for="start_date">{{ __('message.Start Date') }}</label>
                                                <input type="date" class="form-control" id="start_date" name="start_date" required>
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
                                                <input type="date" class="form-control" id="end_date" name="end_date" required>
                                            </div>
                                            @if ($errors->has('end_date'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('end_date') }}</strong>
                                                </span>
                                            @endif
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
@endsection