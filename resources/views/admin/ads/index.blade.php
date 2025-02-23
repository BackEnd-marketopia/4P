@extends('admin.layouts.app')
@section('title', 'Advertisements')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">{{ __('message.Advertisements') }}</h4>
                                <a class="btn btn-secondary btn-round ms-auto" href="{{ route('admin.ads.create') }}">
                                    <i class="fa fa-plus"></i>
                                    {{ __('message.Add Advertisement') }}
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>{{ __('message.Name') }}</th>
                                            <th>{{ __('message.Start Date') }}</th>
                                            <th>{{ __('message.End Date') }}</th>
                                            <th>{{ __('message.Viewed') }}</th>
                                            <th>{{ __('message.Clicked') }}</th>
                                            <th>{{ __('message.Image') }}</th>
                                            <th style="width: 10%">{{ __('message.Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>{{ __('message.Name') }}</th>
                                            <th>{{ __('message.Start Date') }}</th>
                                            <th>{{ __('message.End Date') }}</th>
                                            <th>{{ __('message.Viewed') }}</th>
                                            <th>{{ __('message.Clicked') }}</th>
                                            <th>{{ __('message.Image') }}</th>
                                            <th style="width: 10%">{{ __('message.Action') }}</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($ads as $ad)

                                            <tr>
                                                <td>{{ Str::limit($ad->name, 100) }}</td>
                                                <td>{{ Str::limit($ad->start_date, 100) }}</td>
                                                <td>{{ Str::limit($ad->end_date, 100) }}</td>
                                                <td>{{ Str::limit($ad->viewed, 100) }}</td>
                                                <td>{{ Str::limit($ad->clicked, 100) }}</td>
                                                <td><img src="{{ asset($ad->image) }}" alt="{{ $ad->name }}" width="70px"
                                                        height="70px" style="border-radius: 5px;"></td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <a href="{{ route('admin.ads.edit', $ad->id) }}"
                                                            data-bs-toggle="tooltip" title=""
                                                            class="btn btn-link btn-primary btn-lg"
                                                            data-original-title="Edit Task">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('admin.ads.destroy', $ad->id) }}" method="POST"
                                                            style="display:inline">
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
                                {{ $ads->links() }}
                                <p>{{ __('message.Page') }}: {{ $ads->currentPage() }} {{ __('message.of') }}
                                    {{ $ads->lastPage() }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection