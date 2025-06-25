@extends('layouts.app', [
    'elementActive' => 'news'
    ])

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="text-center">
                        <img src="{{ asset('storage/' . $news->image) }}" class="card-img" height="" alt="News Image">
                    </div>
                    <div class="card-body">
                        <h2 class="d-inline-block">{{ $news->title }}</h2>
                        <span class="fw-bold fst-italic">( {{ $news->created_at->format('d-M-Y') }} )</span>

                        <div class="card-text">

                            {!! $news->content !!}
                        </div>
                    </div>
                </div>
                <a href="{{ route('news.admin-index') }}" class="btn btn-dark">Back</a>
            </div>
        </div>
    </div>
@endsection
