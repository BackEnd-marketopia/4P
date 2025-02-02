@extends('vendor.layouts.app')
@section('title', 'Home')
@section('content')
<div class="container">
    <div class="page-inner">
        <h1>{{ $vendor->name }}</h1>
        <div style="text-align: center">
            <img src="{{ asset($vendor->cover) }}" alt="Cover Image" style="width: 100%; height: auto;">
            <p style="margin-top: 20px; font-size: 18px; color: #333; text-align: left;">{{ $vendor->description }}</p>
        </div>
        <h2>{{ __('message.Discounts') }}</h2>
        @foreach ($vendor->discounts as $discount)
            <div
                style=" background-color: rgba(255, 255, 255, 0.8); padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                <h2>{{ $discount->title }}</h2>
                <p>{{ $discount->description }}</p>
                <p><strong>{{ __('message.Start Date') }}: </strong> {{ $discount->start_date }}</p>
                <p><strong>{{ __('message.End Date') }}: </strong> {{ $discount->end_date }}</p>
            </div>
            <br>

        @endforeach
    </div>
</div>
@endsection