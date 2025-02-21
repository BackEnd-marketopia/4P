@extends('admin.layouts.app')
@section('title', 'Cities')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">{{ __('message.Cities') }}</h4>
                                <button class="btn btn-secondary btn-round ms-auto" data-bs-toggle="modal"
                                    data-bs-target="#addRowModal">
                                    <i class="fa fa-plus"></i>
                                    {{ __('message.Add City') }}
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Modal -->
                            <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header border-0">
                                            <h5 class="modal-title">
                                                <span class="fw-mediumbold"> {{ __('message.Add City') }}</span>
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('admin.cities.store') }}" method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group form-group-default">
                                                            <label>{{ __('message.Name Arabic') }}</label>
                                                            <input id="arbicName" type="text" class="form-control"
                                                                name="name_arabic"
                                                                placeholder="{{ __('message.Name Arabic') }}" />
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group form-group-default">
                                                            <label>{{ __('message.Name English') }}</label>
                                                            <input id="englishName" type="text" class="form-control"
                                                                name="name_english"
                                                                placeholder="{{ __('message.Name English') }}" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer border-0">
                                                    <button type="submit" id="addRowButton" class="btn btn-secondary">
                                                        {{ __('message.Add') }}
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>{{ __('message.Name Arabic') }}</th>
                                            <th>{{ __('message.Name English') }}</th>
                                            <th style="width: 10%">{{ __('message.Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>{{ __('message.Name Arabic') }}</th>
                                            <th>{{ __('message.Name English') }}</th>
                                            <th style="width: 10%">{{ __('message.Action') }}</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($cities as $city)

                                            <tr>
                                                <td>{{ $city->name_arabic }}</td>
                                                <td>{{ $city->name_english }}</td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <a href="{{ route('admin.cities.edit', $city->id) }}"
                                                            data-bs-toggle="tooltip" title=""
                                                            class="btn btn-link btn-primary btn-lg"
                                                            data-original-title="Edit Task">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('admin.cities.destroy', $city->id) }}"
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection