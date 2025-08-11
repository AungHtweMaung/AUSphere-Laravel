@php
    use Illuminate\Support\Str;
@endphp

@extends('layouts.app', [
    'elementActive' => 'events'
    ])

@section('css')
    <link rel="stylesheet" href="{{ asset('css/events.css') }}">
@endsection
@section('content')
    @if (auth()->user()->role == 'admin')
        @include('events.partials.admin-index')
    @else
        @include('events.partials.user-index')
        {{-- @include('news.partials.admin-index') --}}

    @endif
@endsection





