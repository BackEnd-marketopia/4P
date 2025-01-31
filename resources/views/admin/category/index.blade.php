@extends('admin.layouts.app')
@section('title', 'Categories')
@section('content')
<div class="container">
    <div class="page-inner">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">{{ __('message.Categories') }}</h4>
                            <a class="btn btn-secondary btn-round ms-auto" href="{{ route('admin.categories.create') }}">
                                <i class="fa fa-plus"></i>
                                {{ __('message.Add Category') }}
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
                                        <th>{{ __('message.Sort Order') }}</th>
                                        <th>{{ __('message.Image') }}</th>
                                        <th style="width: 10%">{{ __('message.Action') }}</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>{{ __('message.Name Arabic') }}</th>
                                        <th>{{ __('message.Name English') }}</th>
                                        <th>{{ __('message.Sort Order') }}</th>
                                        <th>{{ __('message.Image') }}</th>
                                        <th style="width: 10%">{{ __('message.Action') }}</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($categories as $category)

                                            <tr>
                                            <td>{{ $category->name_arabic }}</td>
                                            <td>{{ $category->name_english }}</td>
                                            <td>{{ $category->sort_order }}</td>
                                            <td><img src="{{ asset($category->image) }}" alt="{{ $category->name_english }}"
                                                    width="70px" height="70px" style="border-radius: 5px;"></td>
                                            <td>
                                                <div class="form-button-action">
                                                    <a href="{{ route('admin.categories.edit', $category->id) }}"
                                                        data-bs-toggle="tooltip" title=""
                                                        class="btn btn-link btn-primary btn-lg"
                                                        data-original-title="Edit Task">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('admin.categories.destroy', $category->id) }}"
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
                            {{ $categories->links() }}
                            <p>{{ __('message.Page') }}: {{ $categories->currentPage() }} {{ __('message.of') }}
                                {{ $categories->lastPage() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection