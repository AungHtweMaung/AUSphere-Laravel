@extends('layouts.app', ['elementActive' => 'academic-calendars'])
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h2 class="text-center">Create Acamedic Calendar</h2>
                <form  method="POST" action="{{ route('academic-calendars.store') }}" class="form-submit">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control"  id="title" name="title" placeholder="Enter title" required>
                        <div class="invalid-feedback" data-error-for="title"></div>

                    </div>
                    <div class="form-group">
                        <label for="calendar_file">Upload Calendar File</label>
                        <input type="file" class="form-control"  id="calendar_file" name="calendar_file" required>
                        <div class="invalid-feedback" data-error-for="calendar_file"></div>

                    </div>
                    <div class="text-end">
                        <a href="{{route('academic-calendars.index')}}" class="btn btn-dark">Back</a>

                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

