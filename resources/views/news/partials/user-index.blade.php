@php
    use Illuminate\Support\Str;
@endphp

@extends('layouts.app', [
    'elementActive' => 'news'
    ])

@section('css')
    <link rel="stylesheet" href="{{ asset('css/user-news.css') }}">
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <h2 class="text-center mb-5">News List</h2>
        <div class="row">

            @foreach ($news as $new)
            <div class="col-sm-6 col-md-4 col-lg-3 mb-3" >
                <a href="{{ route('news.show', $new->id) }}">
                    <div class="card news-card shadow-sm p-3" >
                        <div class="card-title text-center">
                            <img src="{{ asset('storage/'. $new->image) }}" class="news-card-image"style="max-width: 300px; width:100%; height: 200px;">
                        </div>
                        <div class="card-body">
                            <p>{{ $new->created_at->format('d-m-Y') }}</p>
                            <p>{{ $new->title }}</p>
                            <p>{!! Str::limit($new->content, 50, '...') !!}</p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        <div>
            {{ $news->links() }}
        </div>

    </div>
</div>
@endsection
