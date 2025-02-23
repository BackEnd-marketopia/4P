@extends('provider.layouts.app')
@section('title', 'Lessons')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">{{ __('message.Lessons') }}</h4>
                                <a class="btn btn-secondary btn-round ms-auto"
                                    href="{{ route('provider.lessons.create') }}">
                                    <i class="fa fa-plus"></i>
                                    {{ __('message.Add Lesson') }}
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>{{ __('message.Name') }}</th>
                                            <th>{{ __('message.Description') }}</th>
                                            <th>{{ __('message.Sort Order') }}</th>
                                            <th>{{ __('message.Class Room') }}</th>
                                            <th>{{ __('message.Unit') }}</th>
                                            <th>{{ __('message.Education Department') }}</th>
                                            <th>{{ __('message.Image') }}</th>
                                            <th style="width: 10%">{{ __('message.Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>{{ __('message.Name') }}</th>
                                            <th>{{ __('message.Description') }}</th>
                                            <th>{{ __('message.Sort Order') }}</th>
                                            <th>{{ __('message.Class Room') }}</th>
                                            <th>{{ __('message.Unit') }}</th>
                                            <th>{{ __('message.Education Department') }}</th>
                                            <th>{{ __('message.Image') }}</th>
                                            <th style="width: 10%">{{ __('message.Action') }}</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($lessons as $lesson)
                                            <tr>
                                                <td>{{ Str::limit($lesson->name, 100) }}</td>
                                                <td>{{ Str::limit($lesson->description, 100) }}</td>
                                                <td>{{ $lesson->sort_order }}</td>

                                                @if (app()->getLocale() == 'ar')
                                                    <td>{{ $lesson->unit->classRoom->name_arabic }}</td>
                                                @else
                                                    <td>{{ $lesson->unit->classRoom->name_english }}</td>
                                                @endif

                                                @if (app()->getLocale() == 'ar')
                                                    <td>{{ $lesson->unit->name_arabic }}</td>
                                                @else
                                                    <td>{{ $lesson->unit->name_english }}</td>
                                                @endif

                                                @if (app()->getLocale() == 'ar')
                                                    <td>{{ $lesson->unit->classRoom->educationDepartment->name_arabic }}</td>
                                                @else
                                                    <td>{{ $lesson->unit->classRoom->educationDepartment->name_english }}</td>
                                                @endif
                                                <td>
                                                    <img src="{{ asset($lesson->image) }}" alt="image" width="70px"
                                                        height="70px" style="border-radius: 5px;">
                                                </td>
                                                <td>
                                                    <div class="form-button-action">
                                                        <a href="{{ route('provider.lessons.edit', $lesson->id) }}"
                                                            data-bs-toggle="tooltip" title="Edit"
                                                            class="btn btn-link btn-primary btn-lg">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('provider.lessons.destroy', $lesson->id) }}"
                                                            method="POST" style="display:inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" data-bs-toggle="tooltip" title="Remove"
                                                                class="btn btn-link btn-danger delete-btn">
                                                                <i class="fa fa-times"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $lessons->links() }}
                                <p>{{ __('message.Page') }}: {{ $lessons->currentPage() }} {{ __('message.of') }}
                                    {{ $lessons->lastPage() }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection