<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @include('filters.events-filter')
            <h1 class="text-center">Events</h1>
            @foreach ($events as $event)
                <div class="card events-card p-md-5 p-3 my-5 shadow-sm">

                    <div class="row d-flex flex-md-row flex-column-reverse">
                        <div class="col-md-7">
                            <h3 class="mb-0">{{ $event->title }}</h3>
                            <p>{!! $event->content ?? $event->content !!}</p>
                            <div class="my-3">
                                @if ($event->date)
                                    <strong>Date:</strong> {{ $event->date ?? '' }} <br>
                                @endif
                                @if ($event->start_time || $event->end_time)
                                    <strong>Time:</strong> {{ $event->start_time ?? '' }} - {{ $event->end_time ?? '' }}
                                    <br>
                                @endif
                                @if ($event->location)
                                    <strong>Location:</strong> {{ $event->location ?? '' }} <br>
                                @endif


                            </div>

                        </div>
                        <div class="col-md-5 text-center my-3 my-md-0">
                            @if (!empty($event->image))
                                <a href="{{ asset('storage/' . $event->image) }}" target="_blank">
                                    <img src="{{ asset('storage/' . $event->image) }}" alt="Event Image"
                                        style="max-width:400px; width:100%; height:auto;">
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="">
                {{ $events->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>
