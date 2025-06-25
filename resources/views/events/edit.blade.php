@extends('layouts.app', [
    'elementActive' => 'events'
    ])

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h2 class="text-center">Edit Event</h2>
                <form  method="POST" action="{{ route('events.update', $event) }}" enctype="multipart/form-data" class="form-submit">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="title">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" required value="{{ $event->title }}">
                        <div class="invalid-feedback" data-error-for="title"></div>
                    </div>
                    <div class="form-group">
                        <label for="content">Content <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="content" id="content" cols="30" rows="5" placeholder="Enter content" required>{{ $event->content }}</textarea>
                        <div class="invalid-feedback" data-error-for="content"></div>
                    </div>
                    <div class="form-group">
                        <label for="location">Location</label>
                        <input type="text" class="form-control" id="location" name="location" placeholder="Enter location" value="{{ $event->location ?? '' }}">
                        <div class="invalid-feedback" data-error-for="location"></div>
                    </div>

                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                        <div class="invalid-feedback" data-error-for="image"></div>
                        @if($event->image)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $event->image) }}" alt="Current Image" style="max-width: 150px;">
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" class="form-control date-picker" id="date" name="date" placeholder="Select date..." value="{{ $event->date }}">
                        <div class="invalid-feedback" data-error-for="date"></div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="start_time">Start Time</label>
                            <input type="time" class="form-control time-picker" id="start_time" name="start_time" placeholder="Start time" value="{{ $event->start_time ?? '' }}">
                            <div class="invalid-feedback" data-error-for="start_time"></div>
                        </div>
                        <div class="form-group col-6">
                            <label for="end_time">End Time</label>
                            <input type="time" class="form-control time-picker" id="end_time" name="end_time" placeholder="End time" value="{{ $event->end_time ?? '' }}">
                            <div class="invalid-feedback" data-error-for="end_time"></div>
                        </div>
                    </div>
                    </div>
                    <div class="text-end">
                        <a href="{{route('events.index')}}" class="btn btn-dark">Back</a>

                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>





        </div>
    </div>
</div>
@endsection

