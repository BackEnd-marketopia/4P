@extends('admin.layouts.app')
@section('title', 'Banners')
@section('content')
<div class="container">
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">{{ __('message.Banners') }}</h4>
                            <a class="btn btn-secondary btn-round ms-auto" href="{{ route('admin.banners.create') }}">
                                <i class="fa fa-plus"></i>
                                {{ __('message.Add Banner') }}
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
                                        <th style="width: 10%">{{ __('message.Action') }}</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>{{ __('message.Name Arabic') }}</th>
                                        <th>{{ __('message.Name English') }}</th>
                                        <th>{{ __('message.Image') }}</th>
                                        <th style="width: 10%">{{ __('message.Action') }}</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($banners as $banner)

                                        <tr>
                                            <td>{{ $banner->name_arabic }}</td>
                                            <td>{{ $banner->name_english }}</td>
                                            <td><img src="{{ asset($banner->image) }}" alt="{{ $banner->name_english }}" width="70px" height="70px" style="border-radius: 5px;"></td>
                                            <td>
                                                <div class="form-button-action">
                                                    <a href="{{ route('admin.banners.edit', $banner->id) }}"
                                                        data-bs-toggle="tooltip" title=""
                                                        class="btn btn-link btn-primary btn-lg"
                                                        data-original-title="Edit Task">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('admin.banners.destroy', $banner->id) }}"
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
                            {{ $banners->links() }}
                        <p>{{ __('message.Page') }}: {{ $banners->currentPage() }} {{ __('message.of') }} {{ $banners->lastPage() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection