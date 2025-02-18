@extends('provider.layouts.app')
@section('title', 'Class Rooms')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">{{ __('message.Class Rooms') }}</h4>
                                <a class="btn btn-secondary btn-round ms-auto"
                                    href="{{ route('provider.class-rooms.create') }}">
                                    <i class="fa fa-plus"></i>
                                    {{ __('message.Add Class Room') }}
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>{{ __('message.Name Arabic') }}</th>
                                            <th>{{ __('message.Name English') }}</th>
                                            <th>{{ __('message.Image') }}</th>
                                            <th>{{ __('message.Sort Order') }}</th>
                                            <th style="width: 10%">{{ __('message.Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>{{ __('message.Name Arabic') }}</th>
                                            <th>{{ __('message.Name English') }}</th>
                                            <th>{{ __('message.Image') }}</th>
                                            <th>{{ __('message.Sort Order') }}</th>
                                            <th style="width: 10%">{{ __('message.Action') }}</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($classRooms as $classRoom)
                                            <tr>
                                                <td>{{ Str::limit($classRoom->name_arabic, 100) }}</td>
                                                <td>{{ Str::limit($classRoom->name_english, 100) }}</td>
                                                <td>
                                                    <img src="{{ asset($classRoom->image) }}" alt="image" width="70px"
                                                        height="70px" style="border-radius: 5px;">
                                                </td>
                                                <td>{{ $classRoom->sort_order }}</td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <a href="{{ route('provider.class-rooms.edit', $classRoom->id) }}"
                                                            data-bs-toggle="tooltip" title=""
                                                            class="btn btn-link btn-primary btn-lg" data-original-title="Edit">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <form
                                                            action="{{ route('provider.class-rooms.destroy', $classRoom->id) }}"
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
                                {{ $classRooms->links() }}
                                <p>{{ __('message.Page') }}: {{ $classRooms->currentPage() }} {{ __('message.of') }}
                                    {{ $classRooms->lastPage() }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection