@extends('provider.layouts.app')
@section('title', 'Home')
@section('content')
    <div class="container">
        <div class="page-inner">
            <section>
                <div style="position: relative; height: 240px;">
                    <img src="https://pagedone.io/asset/uploads/1705473908.png" alt="cover-image"
                        style="width: 100%; height: 240px; object-fit: cover; filter: sepia(1) saturate(6) hue-rotate(-50deg);">


                    <div class="container">
                        @if (auth('web')->user()->provider->logo)
                            <img src='{{ asset(auth('web')->user()->provider->logo) }}' alt="image"
                                style="border: 4px solid #fff; border-radius: 50%; object-fit: cover; position: absolute; bottom: -50px;"
                                width="120" height="120" width="120" height="120">
                        @else
                            <img src='https://pagedone.io/asset/uploads/1705471668.png' alt="image"
                                style="border: 4px solid #fff; border-radius: 50%; object-fit: cover; position: absolute; bottom: -50px;"
                                width="120" height="120" width="120" height="120">
                        @endif
                    </div>
                </div>
                <div class="container">
                    <div class="profile-info" style="margin-top: 70px;">
                        <div style="display: flex; justify-content: space-between; align-items: start;">
                            @if (app()->getLocale() == 'ar')
                                <h3>{{ auth('web')->user()->provider->name_arabic }}</h3>
                            @else
                                <h3>{{ auth('web')->user()->provider->name_english }}</h3>
                            @endif
                            {{-- <button class="btn btn-primary">
                                Send Message
                            </button> --}}
                        </div>
                        {{-- <p>Engineer at BB Agency Industry <br> New York, United
                            States</p> --}}
                    </div>
                    <div class="tags">
                        <a href="https://wa.me/{{ auth('web')->user()->provider->whatsapp }}" class="tag">
                            <i class="fab fa-whatsapp"></i> {{ auth('web')->user()->provider->whatsapp }}
                        </a>
                        <a href="https://{{ auth('web')->user()->provider->facebook }}" class="tag">
                            <i class="fab fa-facebook"></i> {{ auth('web')->user()->provider->facebook }}
                        </a>
                        <a href='https://{{ auth('web')->user()->provider->instagram }}' class="tag">
                            <i class="fab fa-instagram"></i> {{ auth('web')->user()->provider->instagram }}
                        </a>
                        <a href="#" class="tag">
                            <i class="fas fa-map-marker-alt"></i> {{ auth('web')->user()->provider->address }}
                        </a>
                    </div>
                    <hr>
                    <div class="container">
                        <h3 class="classrooms-title">{{ __('message.Class Rooms') }}</h3>
                        @foreach($classRooms as $classRoom)
                            <div class="classroom-card">
                                <div class="classroom-detail">
                                    <img src="{{ asset($classRoom->image) }}" alt="{{ $classRoom->name_english }}" width="50"
                                        height="100">
                                </div>
                                <div class="classroom-detail">
                                    <strong>{{ __('Name:') }}</strong>
                                    @if(app()->getLocale() == 'ar')
                                        {{ $classRoom->name_arabic }}
                                    @else
                                        <p>{{ $classRoom->name_english }}</p>
                                    @endif
                                </div>
                                <div class="classroom-detail">
                                    <strong>{{ __('Education Department:') }}</strong>
                                    @if(app()->getLocale() == 'ar')
                                        <p>{{ $classRoom->educationDepartment->name_arabic ?? 'N/A' }}</p>
                                    @else
                                        <p>{{ $classRoom->educationDepartment->name_english ?? 'N/A' }}</p>
                                    @endif
                                </div>


                            </div>
                        @endforeach
                    </div>

                    <style>
                        .classroom-card {
                            background: #f9f9f9;
                            padding: 20px;
                            margin: 10px 0;
                            border-radius: 8px;
                            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                        }

                        .classroom-detail {
                            margin-bottom: 15px;
                        }

                        .classroom-detail strong {
                            display: block;
                            font-weight: bold;
                            margin-bottom: 5px;
                        }

                        .classroom-detail p {
                            margin: 0;
                        }

                        .classroom-detail img {
                            max-width: 100%;
                            height: auto;
                            border-radius: 8px;
                        }
                    </style>

                </div>
            </section>
        </div>
    </div>
@endsection