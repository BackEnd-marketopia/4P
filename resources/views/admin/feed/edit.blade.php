@extends('admin.layouts.app')
@section('title', 'Edit Feed')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">{{ __('message.Edit Feed') }}</h3>
                <h6 class="op-7 mb-2">4P</h6>
            </div>
        </div>
        <form action="{{ route('admin.feeds.update', $player_form->id) }}" method="POST" enctype="multipart/form-data">
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
                                                {{ $errors->has('title') ? ' has-danger' : '' }}">
                                                <label for="title">{{ __('message.Title') }}</label>
                                                <input type="text" class="form-control" id="title" name="title"
                                                    value="{{ $player_form->title }}" required>
                                            </div>
                                            @if ($errors->has('title'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('title') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group
                                                {{ $errors->has('short_description') ? ' has-danger' : '' }}">
                                                <label
                                                    for="short_description">{{ __('message.Short Description') }}</label>
                                                <input type="text" class="form-control" id="short_description"
                                                    name="short_description" value="{{ $player_form->short_description }}" required>
                                            </div>
                                            @if ($errors->has('short_description'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('short_description') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group
                                                {{ $errors->has('description') ? ' has-danger' : '' }}">
                                                <label for="description">{{ __('message.Description') }}</label>
                                                <textarea type="text" class="form-control" id="description"
                                                    name="description" required>{{ $player_form->description }}</textarea>
                                            </div>
                                            @if ($errors->has('description'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('description') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group
                                                {{ $errors->has('url') ? ' has-danger' : '' }}">
                                                <label for="url">{{ __('message.URL') }}</label>
                                                <input type="text" class="form-control" id="url" name="url"
                                                value="{{ $player_form->url }}">
                                            </div>
                                            @if ($errors->has('url'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('url') }}</strong>
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
        </form>
    </div>
</div>
@endsection