@extends('admin.layouts.app')
@section('title', 'Notifications')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">{{ __('message.Notifications') }}</h4>
                                <a class="btn btn-secondary btn-round ms-auto"
                                    href="{{ route('admin.notifications.create') }}">
                                    <i class="fa fa-plus"></i>
                                    {{ __('message.Add Notification') }}
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>{{ __('message.Title') }}</th>
                                            <th>{{ __('message.Body') }}</th>
                                            <th>{{ __('message.Type') }}</th>
                                            <th>{{ __('message.To') }}</th>
                                            <th style="width: 10%">{{ __('message.Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>{{ __('message.Title') }}</th>
                                            <th>{{ __('message.Body') }}</th>
                                            <th>{{ __('message.Type') }}</th>
                                            <th>{{ __('message.To') }}</th>
                                            <th style="width: 10%">{{ __('message.Action') }}</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($notifications as $notification)

                                            <tr>
                                                <td>{{ Str::limit($notification->title, 100) }}
                                                    @if($notification->image)
                                                        <img src="{{ asset($notification->image) }}" width="50px" height="50px"
                                                            alt="logo" style="border-radius: 10%">
                                                    @endif
                                                </td>
                                                <td>{{ Str::limit($notification->body, 100) }}</td>
                                                <td>{{ Str::limit($notification->type, 100) }}</td>
                                                @if($notification->to == 'users')
                                                    <td>{{ Str::limit(__('message.All'), 100) }}</td>
                                                @elseif ($notification->to != 'users')
                                                    <td>{{ Str::limit(__('message.Cities'), 100) }}</td>
                                                @endif
                                                <td>
                                                    <div class="form-button-action">
                                                        {{-- <a
                                                            href="{{ route('admin.notifications.edit', $notification->id) }}"
                                                            data-bs-toggle="tooltip" title=""
                                                            class="btn btn-link btn-primary btn-lg"
                                                            data-original-title="Edit Task">
                                                            <i class="fa fa-edit"></i>
                                                        </a> --}}
                                                        <form
                                                            action="{{ route('admin.notifications.destroy', $notification->id) }}"
                                                            method="POST" style="display:inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" data-bs-toggle="tooltip" title=""
                                                                class="btn btn-link btn-danger delete-btn"
                                                                data-original-title="Remove">
                                                                <i class="fa fa-times"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>

                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                {{ $notifications->links() }}
                                <p>{{ __('message.Page') }}: {{ $notifications->currentPage() }} {{ __('message.of') }}
                                    {{ $notifications->lastPage() }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection