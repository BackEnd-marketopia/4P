@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="page-inner">
        <h1 class="my-4">{{ __('message.Feed') }}</h1>
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="card mb-3" style="max-width: 300px;">
                    <img src="{{ asset($feed->image) }}" alt="{{ $feed->title }}" class="card-img-top img-fluid rounded shadow-sm">
                </div>
                <h5 class="card-title">{{ $feed->title }}</h5>
                <p class="card-text">{{ $feed->description }}</p>
                <p class="card-text"><strong>{{ __('message.Created At') }}:</strong> {{ $feed->created_at->format('d M Y, h:i A') }}</p>
                <p class="card-text"><strong>{{ __('message.Updated At') }}:</strong> {{ $feed->updated_at->format('d M Y, h:i A') }}</p>
            </div>
        </div>
        <a href="{{ route('admin.feeds.index') }}" class="btn btn-secondary mt-3">{{ __('message.Back to Feed List') }}</a>
    </div>
</div>
@endsection