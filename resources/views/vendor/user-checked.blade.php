@extends('vendor.layouts.app')
@section('title', 'User Checked')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">{{ __('message.Users Checked') }}</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>{{ __('message.Name') }}</th>
                                            <th>{{ __('message.Phone') }}</th>
                                            <th>{{ __('message.Created At') }}</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>{{ __('message.Name') }}</th>
                                            <th>{{ __('message.Phone') }}</th>
                                            <th>{{ __('message.Created At') }}</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($users as $user)

                                            <tr>
                                                <td>{{ Str::limit($user->name, 100) }}</td>
                                                <td>{{ Str::limit($user->phone, 100) }}</td>
                                                <td>{{ $user->pivot->created_at }}</td>
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