@extends('layouts.app')
@section('content')
    <h1>Dashboard</h1>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif
@endsection

@push('js')

@endpush
