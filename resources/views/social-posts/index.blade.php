@extends('layouts.app', [
    'elementActive' => 'trend-posts',
])

@section('css')
    <link rel="stylesheet" href="{{ asset('css/social-posts.css') }}">
@endsection
@section('content')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h2 class="text-center">Trending Posts</h2>
            @include('social-posts.list', ['socialPosts' => $socialPosts])
        </div>
    </div>
@endsection


@push('js')
    <script src="{{ asset('js/social-posts.js') }}"></script>
@endpush
