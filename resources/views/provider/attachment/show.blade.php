@extends('provider.layouts.app')
@section('title', 'View Attachment')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">{{ __('message.View Attachment') }}</h3>
                    <h6 class="op-7 mb-2">4P</h6>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h4 class="fw-bold">{{ $attachment->name }}</h4>
                    <p><strong>{{ __('message.Type') }}:</strong> {{ ucfirst($attachment->type) }}</p>
                    <p><strong>{{ __('message.Sort Order') }}:</strong> {{ $attachment->sort_order }}</p>
                    <p><strong>{{ __('message.Lesson') }}:</strong> {{ $attachment->lesson->name }}</p>

                    @if ($attachment->type == 'pdf')
                        <embed src="{{ asset($attachment->url) }}" type="application/pdf" width="100%" height="500px" />
                    @elseif ($attachment->type == 'video')
                        <video width="100%" height="500px" controls>
                            <source src="{{ asset($attachment->url) }}" type="video/mp4">
                            {{ __('message.Your browser does not support the video tag.') }}
                        </video>
                    @elseif ($attachment->type == 'audio')
                        <audio controls style="width:100%; height:500px">
                            <source src="{{ asset($attachment->url) }}" type="audio/mpeg">
                            {{ __('message.Your browser does not support the audio tag.') }}
                        </audio>
                    @endif

                    <div class="mt-3">
                        <a href="{{ route('provider.attachments.index') }}" class="btn btn-secondary">
                            {{ __('message.Back') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection