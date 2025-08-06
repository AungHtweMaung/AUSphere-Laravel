@php
    use Illuminate\Support\Str;
@endphp

@extends('layouts.app', ['elementActive' => 'academic-calendars'])

@section('content')
<div class="row">
    <div class="col-md-12">
        {{-- @include('filters.departments-filter') --}}
        <div class="card">
            <div class="card-body">
                {{-- @dd(route('news.create')) --}}
                <a href="{{ route('academic-calendars.create') }}" class="btn btn-primary">Create</a>
                <h2 class="text-center mt-3">Academic Calendar</h2>
                <div class="table-responsive">
                    <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="col-2">No</th>
                            <th>Title</th>
                            <th>Calendar File</th>
                            {{-- <th></th> --}}
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $num = ($academicCalendars->currentPage() - 1) * $academicCalendars->perPage() + 1;
                        @endphp
                        @foreach($academicCalendars as $calendar)
                        <tr class="">
                            <td>{{ $num }}</td>
                            <td >{{ Str::limit($calendar->title, 100, '...') }}</td>
                            <td>
                                <a href="{{ asset('storage/'. $calendar->calendar_file) }}" target="_blank" class="fs-6">
                                    <span class="text-primary"><i class="fa-solid fa-file"></i> View File</span>
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('academic-calendars.show', $calendar->id) }}" class="btn btn-warning btn-sm text-white">
                                    <i class="fa-regular fa-eye"></i>
                                </a>
                                <a href="{{ route('academic-calendars.edit', $calendar->id) }}" class="btn btn-primary btn-sm text-white">
                                    <i class="fa-regular fa-edit"></i>
                                </a>
                                <button data-href="{{ route('academic-calendars.destroy', $calendar->id) }}" class="btn btn-danger btn-sm text-white delete-data">
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                            </td>
                        </tr>
                        @php
                            $num ++;
                        @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td >
                                {{-- <div class="d-flex justify-content-center"> --}}
                                    {{ $academicCalendars->appends(request()->query())->links() }}
                                {{-- </div> --}}
                            </td>
                        </tr>
                    </tfoot>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
