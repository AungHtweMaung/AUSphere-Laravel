@extends('layouts.app', [
    'elementActive' => 'news',
])

@section('content')
    <div class="container">
        <div class="card p-md-5 p-3">
            <div class="row d-flex flex-md-row flex-column-reverse">
                <div class="col-md-7">
                    <h3 class="bg-primary d-inline-block p-2 text-white">{{ $department->department_type->name ?? '' }}</h3>
                    <div>
                        @if (isset($department->title_short_term))
                            <p class="text-bold bg-primary d-inline-block p-2 text-white">{{ $department->title_short_term }}</p>
                        @endif
                    </div>
                    <h3 class="mb-0">{{ $department->title }}</h3>
                    <p>{!! $department->content !!}</p>
                </div>
                <div class="col-md-4 text-center my-3 my-md-0">
                    <img src="{{ asset('storage/' . $department->image) }}" alt="" style="max-width:300px; width:100%; height:auto;">
                </div>
            </div>
            <div>
                <a href="{{ route('departments.index') }}" class="btn btn-dark">Back</a>

            </div>
        </div>

    </div>
@endsection
