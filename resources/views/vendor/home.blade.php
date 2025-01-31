@extends('vendor.layouts.app')
@section('title', 'Home')
@section('content')
<div class="container">
    <div class="page-inner">
        <div style="text-align: center">
            <img src="{{ asset($vendor->cover) }}" alt="Cover Image" style="width: 100%; height: auto;">
            <p style="margin-top: 20px; font-size: 18px; color: #333; text-align: left;">{{ $vendor->description }}</p>
        </div>
        <div style=" background-color: rgba(255, 255, 255, 0.8); padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);"></div>
    </div>
</div>
@endsection