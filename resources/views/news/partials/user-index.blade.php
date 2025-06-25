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
        {{-- @include('filters.news-filter') --}}
        <h2 class="text-center mb-5">News List</h2>
        <div class="row">
            @foreach ($news as $new)
            <div class="col-sm-6 col-md-4 col-xl-3 mb-5" >
                <a href="{{ route('news.show', $new->id) }}">
                    <div class="card news-card shadow-sm p-3" >
                        <div class="card-title text-center">
                            <img src="{{ asset('storage/'. $new->image) }}" class="news-card-image"style="max-width: 400px; width:100%; max-height: 250px;">
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
            {{ $news->appends(request()->query())->links() }}
        </div>

    </div>
</div>
@endsection
