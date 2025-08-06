@php
    use Illuminate\Support\Str;
@endphp

@extends('layouts.app', [
    'elementActive' => 'academic-calendars'
    ])

@section('css')
    <link rel="stylesheet" href="{{ asset('css/academic-calendars.css') }}">

@endsection
@section('content')
    @if (auth()->user()->role == 'admin')
        @include('acamedic-calendars.partials.admin-index')
    @else
        @include('acamedic-calendars.partials.user-index')
        {{-- @include('news.partials.admin-index') --}}

    @endif
@endsection






















