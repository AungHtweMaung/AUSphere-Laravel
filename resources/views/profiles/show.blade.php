@php
    use Illuminate\Support\Str;
@endphp

@extends('layouts.app', [
    'elementActive' => 'profiles',
])

@section('css')
    <link rel="stylesheet" href="{{ asset('css/social-posts.css') }}">
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row justify-content-center mb-3">
                <div class="col-md-8 col-lg-6">
                    <div class="card shadow">
                        <div class="card-body">
                            <form action="{{ route('profiles.update', $profile->id) }}" method="POST" class="form-submit">
                                @csrf
                                @method('PUT')
                                <input type="hidden" value="{{ $profile->id }}" name="profile_id">
                                <div class="text-center">
                                    <img src="{{ asset('src/assets/images/default-user-image.svg') }}"
                                        style="max-width: 200px;" alt="">
                                </div>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ $profile->name }}" required>
                                    <div class="invalid-feedback" data-error-for="name"></div>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" id="email" name="email"
                                        value="{{ $profile->email }}" required>
                                    <div class="invalid-feedback" data-error-for="email"></div>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-9">
                    <a href="{{ route('social-posts.create', $profile->id) }}" class="btn btn-success">Create</a>
                    <h2 class="text-center">Posts</h2>
                    @if ($profile->socialPosts->isEmpty())
                        {{-- <p class="text-center">No posts available.</p> --}}
                    @else
                        @include('social-posts.list', ['socialPosts' => $profile->socialPosts])
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('js/social-posts.js') }}"></script>
@endpush
