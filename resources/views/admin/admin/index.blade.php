@extends('admin.layouts.app')
@section('title', 'Admins')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">{{ __('message.Admins') }}</h4>
                                <a class="btn btn-secondary btn-round ms-auto" href="{{ route('admin.admins.create') }}">
                                    <i class="fa fa-plus"></i>
                                    {{ __('message.Add Admin') }}
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
                                                <td>{{ Str::limit($user->name, 100) }}</td>
                                                <td>{{ Str::limit($user->email, 100) }}</td>
                                                <td>{{ Str::limit($user->phone, 100) }}</td>
                                                <td>{{ Str::limit($user->status, 100) }}</td>
                                                @if($user->id != 1)
                                                    <td>
                                                        <form action="{{ route('admin.admins.destroy', $user->id) }}" method="POST" style="display:inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger delete-btn"
                                                                data-original-title="Remove">
                                                                <i class="fa fa-times"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                @endif
                                                {{-- <td><img src="{{ asset($user->image) }}" alt="{{ $user->name }}" width="70px"
                                                        height="70px" style="border-radius: 5px;"></td> --}}
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                {{ $users->links() }}
                                <p>{{ __('message.Page') }}: {{ $users->currentPage() }} {{ __('message.of') }}
                                    {{ $users->lastPage() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection