@extends('admin.layouts.app')
@section('title', 'Payments')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">{{ __('message.Payments') }}</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>{{ __('message.Order ID') }}</th>
                                            <th>{{ __('message.User Name') }}</th>
                                            <th>{{ __('message.Phone') }}</th>
                                            <th>{{ __('message.Amount') }}</th>
                                            <th>{{ __('message.Status') }}</th>
                                            <th>{{ __('message.Created At') }}</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>{{ __('message.Order ID') }}</th>
                                            <th>{{ __('message.User Name') }}</th>
                                            <th>{{ __('message.Phone') }}</th>
                                            <th>{{ __('message.Amount') }}</th>
                                            <th>{{ __('message.Status') }}</th>
                                            <th>{{ __('message.Created At') }}</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($payments as $payment)
                                            <tr>
                                                <td>{{ $payment->order_id }}</td>
                                                <td>{{ $payment->user->name ?? __('message.Unknown') }}</td>
                                                <td>{{ $payment->user->phone ?? __('message.No Phone') }}</td>
                                                <td>{{ number_format($payment->amount, 2) }}</td>
                                                <td>
                                                    @if ($payment->success)
                                                        <span class="badge bg-success">{{ __('message.Success') }}</span>
                                                    @elseif ($payment->pending)
                                                        <span class="badge bg-warning">{{ __('message.Pending') }}</span>
                                                    @else
                                                        <span class="badge bg-danger">{{ __('message.Failed') }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ $payment->created_at->format('Y-m-d H:i:s') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $payments->links() }}
                                <p>{{ __('message.Page') }}: {{ $payments->currentPage() }} {{ __('message.of') }}
                                    {{ $payments->lastPage() }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection