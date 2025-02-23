@extends('admin.layouts.app')
@section('title', 'Player Forms')
@section('content')

    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">{{ __('message.Player Forms') }}</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>{{ __('message.Name') }}</th>
                                            <th>{{ __('message.Phone') }}</th>
                                            <th>{{ __('message.Age') }}</th>
                                            <th style="width: 10%">{{ __('message.Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>{{ __('message.Name') }}</th>
                                            <th>{{ __('message.Phone') }}</th>
                                            <th>{{ __('message.Age') }}</th>
                                            <th style="width: 10%">{{ __('message.Action') }}</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($player_forms as $player_form)

                                            <tr>
                                                <td>{{ Str::limit($player_form->name, 100) }}</td>
                                                <td>{{ Str::limit($player_form->phone, 100) }}</td>
                                                <td>{{ Str::limit($player_form->age, 100) }}</td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <a href="{{ route('admin.player_forms.show', $player_form->id) }}"
                                                            data-bs-toggle="tooltip" title=""
                                                            class="btn btn-link btn-info btn-lg"
                                                            data-original-title="Show Task">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                        <form
                                                            action="{{ route('admin.player_forms.destroy', $player_form->id) }}"
                                                            method="POST" style="display:inline">
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
                                {{ $player_forms->links() }}
                                <p>{{ __('message.Page') }}: {{ $player_forms->currentPage() }} {{ __('message.of') }}
                                    {{ $player_forms->lastPage() }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection