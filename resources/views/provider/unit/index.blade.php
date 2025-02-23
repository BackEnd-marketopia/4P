@extends('provider.layouts.app')
@section('title', 'Units')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">{{ __('message.Units') }}</h4>
                                <a class="btn btn-secondary btn-round ms-auto" href="{{ route('provider.units.create') }}">
                                    <i class="fa fa-plus"></i>
                                    {{ __('message.Add Unit') }}
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
                                            <th>{{ __('message.Description') }}</th>
                                            <th>{{ __('message.Sort Order') }}</th>
                                            <th>{{ __('message.Class Room') }}</th>
                                            <th>{{ __('message.Education Department') }}</th>
                                            <th>{{ __('message.Image') }}</th>
                                            <th style="width: 10%">{{ __('message.Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>{{ __('message.Name Arabic') }}</th>
                                            <th>{{ __('message.Name English') }}</th>
                                            <th>{{ __('message.Description') }}</th>
                                            <th>{{ __('message.Sort Order') }}</th>
                                            <th>{{ __('message.Class Room') }}</th>
                                            <th>{{ __('message.Education Department') }}</th>
                                            <th>{{ __('message.Image') }}</th>
                                            <th style="width: 10%">{{ __('message.Action') }}</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($units as $unit)
                                            <tr>
                                                <td>{{ Str::limit($unit->name_arabic, 100) }}</td>
                                                <td>{{ Str::limit($unit->name_english, 100) }}</td>
                                                <td>{{ Str::limit($unit->description, 100) }}</td>
                                                <td>{{ $unit->sort_order }}</td>
                                                @if (app()->getLocale() == 'ar')
                                                    <td>{{ $unit->classRoom->name_arabic }}</td>
                                                @else
                                                    <td>{{ $unit->classRoom->name_english }}</td>
                                                @endif
                                                @if (app()->getLocale() == 'ar')
                                                    <td>{{ $unit->classRoom->educationDepartment->name_arabic }}</td>
                                                @else
                                                    <td>{{ $unit->classRoom->educationDepartment->name_english }}</td>
                                                @endif
                                                <td>
                                                    <img src="{{ asset($unit->image) }}" alt="image" width="70px" height="70px"
                                                        style="border-radius: 5px;">
                                                </td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <a href="{{ route('provider.units.edit', $unit->id) }}"
                                                            data-bs-toggle="tooltip" title=""
                                                            class="btn btn-link btn-primary btn-lg" data-original-title="Edit">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('provider.units.destroy', $unit->id) }}"
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
                                {{ $units->links() }}
                                <p>{{ __('message.Page') }}: {{ $units->currentPage() }} {{ __('message.of') }}
                                    {{ $units->lastPage() }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection