@extends('provider.layouts.app')
@section('title', 'Attachments')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">{{ __('message.Attachments') }}</h4>
                                <a class="btn btn-secondary btn-round ms-auto"
                                    href="{{ route('provider.attachments.create') }}">
                                    <i class="fa fa-plus"></i>
                                    {{ __('message.Add Attachment') }}
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>{{ __('message.Name') }}</th>
                                            <th>{{ __('message.Type') }}</th>
                                            <th>{{ __('message.Sort Order') }}</th>
                                            <th>{{ __('message.Class Room') }}</th>
                                            <th>{{ __('message.Unit') }}</th>
                                            <th>{{ __('message.Lesson') }}</th>
                                            <th>{{ __('message.Educational Department') }}</th>
                                            <th style="width: 10%">{{ __('message.Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>{{ __('message.Name') }}</th>
                                            <th>{{ __('message.Type') }}</th>
                                            <th>{{ __('message.Sort Order') }}</th>
                                            <th>{{ __('message.Class Room') }}</th>
                                            <th>{{ __('message.Unit') }}</th>
                                            <th>{{ __('message.Lesson') }}</th>
                                            <th>{{ __('message.Educational Department') }}</th>
                                            <th style="width: 10%">{{ __('message.Action') }}</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($attachments as $attachment)
                                            <tr>
                                                <td>{{ Str::limit($attachment->name, 100) }}</td>
                                                <td>{{ Str::limit($attachment->type, 100) }}</td>
                                                <td>{{ $attachment->sort_order }}</td>

                                                @if (app()->getLocale() == 'ar')
                                                    <td>{{ $attachment->lesson->unit->classRoom->name_arabic }}</td>
                                                @else
                                                    <td>{{ $attachment->lesson->unit->classRoom->name_english }}</td>
                                                @endif

                                                @if (app()->getLocale() == 'ar')
                                                    <td>{{ $attachment->lesson->unit->name_arabic }}</td>
                                                @else
                                                    <td>{{ $attachment->lesson->unit->name_english }}</td>
                                                @endif

                                                <td>{{ $attachment->lesson->name }}</td>

                                                @if (app()->getLocale() == 'ar')
                                                    <td>{{ $attachment->lesson->unit->classRoom->educationDepartment->name_arabic }}</td>
                                                @else
                                                    <td>{{ $attachment->lesson->unit->classRoom->educationDepartment->name_english }}</td>
                                                @endif

                                                <td>
                                                    <div class="form-button-action">
                                                        <a href="{{ route('provider.attachments.show', $attachment->id) }}" data-bs-toggle="tooltip" title="Show"
                                                            class="btn btn-link btn-primary btn-lg">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('provider.attachments.edit', $attachment->id) }}"
                                                            data-bs-toggle="tooltip" title="Edit"
                                                            class="btn btn-link btn-primary btn-lg">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('provider.attachments.destroy', $attachment->id) }}"
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
                                {{ $attachments->links() }}
                                <p>{{ __('message.Page') }}: {{ $attachments->currentPage() }} {{ __('message.of') }}
                                    {{ $attachments->lastPage() }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection