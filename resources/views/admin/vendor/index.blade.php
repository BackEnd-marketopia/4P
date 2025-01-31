@extends('admin.layouts.app')
@section('title', 'Vendors')
@section('content')
<div class="container">
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">{{ __('message.Vendos') }}</h4>
                            <a class="btn btn-secondary btn-round ms-auto" href="{{ route('admin.vendors.create') }}">
                                <i class="fa fa-plus"></i>
                                {{ __('message.Add Vendor') }}
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
                                            @if($user->vendor->status == 'accepted')
                                                <td>{{ Str::limit(__('message.Accepted'), 100) }}</td>
                                            @elseif($user->vendor->status == 'pending')
                                                <td>{{ Str::limit(__('message.Pending'), 100) }}</td>
                                            @else
                                                <td>{{ Str::limit(__('message.Rejected'), 100) }}</td>
                                            @endif
                                            {{-- <td><img src="{{ asset($user->image) }}" alt="{{ $user->name }}" width="70px"
                                                    height="70px" style="border-radius: 5px;"></td> --}}
                                            <td>
                                                <div class="form-button-action">
                                                    <a href="{{ route('admin.vendors.edit', $user->id) }}"
                                                        data-bs-toggle="tooltip" title=""
                                                        class="btn btn-link btn-primary btn-lg"
                                                        data-original-title="Edit Task">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('admin.vendors.destroy', $user->id) }}"
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
                                {{ $users->lastPage() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection