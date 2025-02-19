@extends('admin.layouts.app')
@section('title', 'Providers')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">{{ __('message.Providers') }}</h4>
                                <a class="btn btn-secondary btn-round ms-auto" href="{{ route('admin.providers.create') }}">
                                    <i class="fa fa-plus"></i>
                                    {{ __('message.Add Provider') }}
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>{{ __('message.Name') }}</th>
                                            <th>{{ __('message.Email') }}</th>
                                            <th>{{ __('message.Phone') }}</th>
                                            <th>{{ __('message.Status') }}</th>
                                            {{-- <th>{{ __('message.Image') }}</th> --}}
                                            <th style="width: 10%">{{ __('message.Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>{{ __('message.Name') }}</th>
                                            <th>{{ __('message.Email') }}</th>
                                            <th>{{ __('message.Phone') }}</th>
                                            <th>{{ __('message.Status') }}</th>
                                            {{-- <th>{{ __('message.Image') }}</th> --}}
                                            <th style="width: 10%">{{ __('message.Action') }}</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($users as $user)

                                            <tr>
                                                <td><img src="{{ asset($user->provider->logo) }}" width="50px" height="50px"
                                                        alt="logo" style="border-radius: 10%">
                                                    @if (app()->getLocale() == 'ar')
                                                        {{ Str::limit($user->provider->name_arabic, 100) }}
                                                    @else
                                                        {{ Str::limit($user->provider->name_english, 100) }}

                                                    @endif</td>
                                                <td>{{ Str::limit($user->email, 100) }}</td>
                                                <td>{{ Str::limit($user->phone, 100) }}</td>
                                                @if($user->provider->status == 'accepted')
                                                    <td>{{ Str::limit(__('message.Accepted'), 100) }}</td>
                                                @elseif($user->provider->status == 'pending')
                                                    <td>{{ Str::limit(__('message.Pending'), 100) }}</td>
                                                @else
                                                    <td>{{ Str::limit(__('message.Rejected'), 100) }}</td>
                                                @endif
                                                {{-- <td><img src="{{ asset($user->image) }}" alt="{{ $user->name }}"
                                                        width="70px" height="70px" style="border-radius: 5px;"></td> --}}
                                                <td>
                                                    <div class="form-button-action">
                                                        <a href="{{ route('admin.providers.edit', $user->provider->id) }}"
                                                            data-bs-toggle="tooltip" title=""
                                                            class="btn btn-link btn-primary btn-lg"
                                                            data-original-title="Edit Task">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('admin.providers.destroy', $user->provider->id) }}"
                                                            method="POST" style="display:inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" data-bs-toggle="tooltip" title=""
                                                                class="btn btn-link btn-danger" data-original-title="Remove">
                                                                <i class="fa fa-times"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                {{ $users->links() }}
                                <p>{{ __('message.Page') }}: {{ $users->currentPage() }} {{ __('message.of') }}
                                    {{ $users->lastPage() }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection