@extends('layouts.app', ['elementActive' => 'academic-calendars'])
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="text-center">Edit Acamedic Calendar</h2>
                    <form method="POST" action="{{ route('academic-calendars.update', $academic_calendar) }}"
                        class="form-submit">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title"
                                value="{{ $academic_calendar->title }}" name="title" placeholder="Enter title" required>
                            <div class="invalid-feedback" data-error-for="title"></div>

                        </div>

                        <div class="form-group">
                            <label for="calendar_file">Upload Calendar File</label>
                            <input type="file" class="form-control" id="calendar_file" name="calendar_file">
                            <div class="invalid-feedback" data-error-for="calendar_file"></div>
                            <div class="mt-2">
                                <a href="{{ asset('storage/' . $academic_calendar->calendar_file) }}" target="_blank"
                                    class="fs-6">
                                    <span class="text-primary"><i class="fa-solid fa-file"></i> View Pdf</span>
                                </a>
                            </div>

                        </div>
                        <div class="text-end">
                            <a href="{{ route('academic-calendars.index') }}" class="btn btn-dark">Back</a>

                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
