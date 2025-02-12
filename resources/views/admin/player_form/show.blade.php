@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            <h1 class="my-4">{{ __('message.Player Form') }}</h1>
            <div class="card shadow-sm">
                <div class="card-body">
                    @if($player->images)
                        <div class="text-center mb-3">
                            @foreach(json_decode($player->images, true) as $image)
                                <img src="{{ asset($image) }}" alt="{{ $player->name }}" class="img-fluid rounded shadow-sm m-2"
                                    style="max-width: 100px;">
                            @endforeach
                        </div>
                    @endif

                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>{{ __('message.Name') }}</th>
                                <td>{{ $player->name }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('message.Phone') }}</th>
                                <td>{{ $player->phone }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('message.Age') }}</th>
                                <td>{{ $player->age }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('message.City') }}</th>
                                <td>{{ $player->city_name }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('message.Old Club') }}</th>
                                <td>{{ $player->name_of_old_club }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('message.Current Club') }}</th>
                                <td>{{ $player->name_of_current_club }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('message.Parent Job') }}</th>
                                <td>{{ $player->job_of_parent }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('message.Long-term Diseases') }}</th>
                                <td>{{ $player->long_life_desises ?? __('message.None') }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('message.Injuries') }}</th>
                                <td>{{ $player->injuries ?? __('message.None') }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('message.Created At') }}</th>
                                <td>{{ $player->created_at->format('d M Y, h:i A') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <a href="{{ route('admin.player_forms.index') }}"
                class="btn btn-secondary mt-3">{{ __('message.Back to Player Forms List') }}</a>
        </div>
    </div>
@endsection