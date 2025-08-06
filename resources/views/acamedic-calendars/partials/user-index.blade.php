@foreach ($academicCalendars as $academic_calendar)
    <div class="row my-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center py-2 text-white">{{ $academic_calendar->title }}</h2>
                </div>
                <div class="card-body">
                    <iframe src="{{ asset('storage/' . $academic_calendar->calendar_file) }}" frameborder="0" width="100%"
                    height="700px"></iframe>
                </div>
            </div>
        </div>
    </div>
@endforeach


{{ $academicCalendars->appends(request()->query())->links() }}
