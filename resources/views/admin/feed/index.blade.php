@extends('admin.layouts.app')
@section('title', 'feeds')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">{{ __('message.Feeds') }}</h4>
                                <a class="btn btn-secondary btn-round ms-auto" href="{{ route('admin.feeds.create') }}">
                                    <i class="fa fa-plus"></i>
                                    {{ __('message.Add Feed') }}
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>{{ __('message.Title') }}</th>
                                            <th>{{ __('message.Short Description') }}</th>
                                            <th>{{ __('message.Description') }}</th>
                                            <th>{{ __('message.URL') }}</th>
                                            <th>{{ __('message.Image') }}</th>
                                            <th style="width: 10%">{{ __('message.Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>{{ __('message.Title') }}</th>
                                            <th>{{ __('message.Short Description') }}</th>
                                            <th>{{ __('message.Description') }}</th>
                                            <th>{{ __('message.URL') }}</th>
                                            <th>{{ __('message.Image') }}</th>
                                            <th style="width: 10%">{{ __('message.Action') }}</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($feeds as $feed)

                                            <tr>
                                                <td>{{ Str::limit($feed->title, 100) }}</td>
                                                <td>{{ Str::limit($feed->short_description, 100) }}</td>
                                                <td>{{ Str::limit($feed->description, 100) }}</td>
                                                <td>{{ Str::limit($feed->url, 100) }}</td>
                                                <td><img src="{{ asset($feed->image) }}" alt="{{ $feed->title }}" width="70px"
                                                        height="70px" style="border-radius: 5px;"></td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <a href="{{ route('admin.feed.notification', $feed->id) }}"
                                                            data-bs-toggle="tooltip" title=""
                                                            class="btn btn-link btn-info btn-lg"
                                                            data-original-title="Show Task">
                                                            <i class="fa fa-bell"></i>
                                                        </a>
                                                        <a href="{{ route('admin.feeds.show', $feed->id) }}"
                                                            data-bs-toggle="tooltip" title=""
                                                            class="btn btn-link btn-info btn-lg"
                                                            data-original-title="Show Task">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('admin.feeds.edit', $feed->id) }}"
                                                            data-bs-toggle="tooltip" title=""
                                                            class="btn btn-link btn-primary btn-lg"
                                                            data-original-title="Edit Task">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('admin.feeds.destroy', $feed->id) }}"
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
                                {{ $feeds->links() }}
                                <p>{{ __('message.Page') }}: {{ $feeds->currentPage() }} {{ __('message.of') }}
                                    {{ $feeds->lastPage() }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection