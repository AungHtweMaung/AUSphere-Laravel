@php
    use Illuminate\Support\Str;
@endphp

@extends('layouts.app', [
    'elementActive' => 'news'
    ])
@section('content')
    @if (auth()->user()->role == 'admin')
        @include('news.partials.admin-index')
    @else
        @include('news.partials.user-index')
    @endif
@endsection
