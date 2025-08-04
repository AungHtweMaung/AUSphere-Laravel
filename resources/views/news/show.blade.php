@extends('layouts.app', [
    'elementActive' => 'news'
    ])

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="d-flex align-items-center p-3">
                        <h2 class="d-inline-block">{{ $news->title }}</h2>
                        <span class="fw-bold fst-italic">( {{ $news->created_at->format('d-M-Y') }} )</span>
                        {{-- @dd($news->newsContents[0]['image']) --}}
                    </div>
                    <div class="card-body ">
                        @foreach ($news->newsContents as $newsContent)
                            <img src="{{ asset('storage/' . $newsContent['image']) }}" class="card-img" height="" alt="News Image">
                            <div class="card-text my-3" style="text-align: justify !important; word-spacing: 2px; line-height: 1.6; letter-spacing: 2px; text-indent: 4em;">
                                {{-- @dd($newsContent) --}}
                                {{-- @dd($newsContent['content']) --}}
                                {!! $newsContent['content'] !!}
                            </div>

                        @endforeach

                    </div>
                </div>
                <a href="{{ route('news.index') }}" class="btn btn-dark">Back</a>
            </div>
        </div>
    </div>
@endsection
