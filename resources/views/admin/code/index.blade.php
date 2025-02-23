@extends('admin.layouts.app')
@section('title', 'Codes')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">{{ __('message.Codes') }}</h4>
                                <button class="btn btn-secondary btn-round ms-auto" data-bs-toggle="modal"
                                    data-bs-target="#generateCodeModal">
                                    <i class="fa fa-plus"></i>
                                    {{ __('message.Generate Codes') }}
                                </button>
                                <a href="{{ route('admin.codes.export') }}" class="btn btn-success btn-round ms-2">
                                    {{ __('message.Excel') }}
                                </a>

                            </div>
                        </div>
                        <div class="card-body">

                            <!-- Generate Code Form (Modal) -->
                            <div class="modal fade" id="generateCodeModal" tabindex="-1"
                                aria-labelledby="generateCodeModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="{{ route('admin.codes.store') }}" method="POST">
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="generateCodeModalLabel">
                                                    {{ __('message.Generate Codes') }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="number_of_codes"
                                                        class="form-label">{{ __('message.Number of Codes') }}</label>
                                                    <input type="number" name="number_of_codes" id="number_of_codes"
                                                        class="form-control" min="1" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer border-0">
                                                <button type="submit" class="btn btn-secondary">
                                                    {{ __('message.Add') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Table -->
                            <div class="table-responsive">
                                <table id="code-table" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>{{ __('message.Code') }}</th>
                                            <th>{{ __('message.Status') }}</th>
                                            <th>{{ __('message.Start Date') }}</th>
                                            <th>{{ __('message.End Date') }}</th>
                                            <th>{{ __('message.User') }}</th>
                                            <th style="width: 10%">{{ __('message.Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>{{ __('message.Code') }}</th>
                                            <th>{{ __('message.Status') }}</th>
                                            <th>{{ __('message.Start Date') }}</th>
                                            <th>{{ __('message.End Date') }}</th>
                                            <th>{{ __('message.User') }}</th>
                                            <th style="width: 10%">{{ __('message.Action') }}</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($codes as $code)
                                            <tr>
                                                <td>{{ $code->code }}</td>
                                                <td>
                                                    @if (is_null($code->user_id))
                                                        <span class="badge bg-danger">{{ __('message.Unassigned') }}</span>
                                                    @else
                                                        <span class="badge bg-success">{{ __('message.Assigned') }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ $code->start_date ?? '-' }}</td>
                                                <td>{{ $code->end_date ?? '-' }}</td>
                                                <td>{{ $code->user?->name ?? '-' }}</td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <form action="{{ route('admin.codes.destroy', $code->id) }}"
                                                            method="POST" style="display:inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-link btn-danger delete-btn"
                                                                data-bs-toggle="tooltip">
                                                                <i class="fa fa-times"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $codes->links() }}
                                <p>{{ __('message.Page') }}: {{ $codes->currentPage() }} {{ __('message.of') }}
                                    {{ $codes->lastPage() }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection