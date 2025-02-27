@extends('vendor.layouts.app')
@section('title', 'Home')
@section('content')
    <div class="container">
        <div class="page-inner">
            <h1>{{ $vendor->name }}</h1>
            <div style="text-align: center">
                <img src="{{ asset($vendor->cover) }}" alt="Cover Image" style="width: 100%; height: 300px;">
                <p style="margin-top: 20px; font-size: 18px; color: #333; text-align: left;">{{ $vendor->description }}</p>
            </div>
            <h2>{{ __('message.Discounts') }}</h2>
            @foreach ($vendor->discounts as $discount)
                <div
                    style=" background-color: rgba(255, 255, 255, 0.8); padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                    <img src="{{ asset($discount->image) }}" alt="{{ $discount->title }}" width="50px" height="50px">
                    <h2 style="display: inline">{{ $discount->title }}</h2>
                    {{-- <a style="border-radius: 10%; margin-left: 80%;font-size: large;"> <i class="fas fa-eye"
                            style="color: #BD3625;"></i> {{ $discount->viwe_count }}</a>
                    <a style="border-radius: 10%; margin-left: 5%;font-size: large;"><i class="fas fa-check"
                            style="color: #BD3625"></i> {{$discount->discountCheck->count()}}</a> --}}
                    <p>{{ $discount->description }}</p>
                    <p style="display: inline"><strong>{{ __('message.Start Date') }}: </strong> {{ $discount->start_date }}</p>
                    &nbsp;
                    <p style="display: inline"><strong>{{ __('message.End Date') }}: </strong> {{ $discount->end_date }}</p>
                    <br><br>
                    <p style="color: #BD3625; display: inline;">{{ __('message.Viewed') }}:
                        {{ $discount->viwe_count }}
                    </p>
                    &nbsp;&nbsp;
                    <a style="display: inline" class="btn btn-secondary"
                        href="{{ route('vendor.discount-checked', $discount->id) }}">{{ __('message.Checked') }}:
                        {{$discount->discountChecks->count()}}</a>
                </div>
                <br>

            @endforeach
        </div>
    </div>
@endsection