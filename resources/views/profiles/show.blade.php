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
                    <div class="card">
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
                        @foreach ($social_posts as $post)
                            <div class="card mb-5">
                                <div class="card-body">
                                    <div class="row justify-content-between align-items-center mb-3">
                                        <div class="col-8 col-md-9">
                                            <img src="{{ asset('src/assets/images/default-user-image.svg') }}"
                                                width="30px;" alt=""><span
                                                class="ms-3">{{ $post->user->name }}</span>
                                        </div>
                                        <div class="col-4 col-md-3 me-md-5 me-1 social-posts-menu dropdown ">
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fa-solid fa-ellipsis fa-3x social-posts-menu-icon text-black"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-dark">
                                                <li><a class="dropdown-item" href="#">Edit</a></li>
                                                {{-- <li><a class="dropdown-item" data-href="{{ route('social-posts.destroy', [$profile->id, $post->id]) }}" class="delete-data">Delete</a></li> --}}
                                                <li>
                                                    <button data-href="{{ route('social-posts.destroy', [$profile->id, $post->id]) }}" class="dropdown-item delete-data">
                                                        Delete
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <p class="card-text">{!! $post->content !!}</p>
                                    <p class="card-text"><small
                                            class="text-muted">{{ $post->created_at->diffForHumans() }}</small></p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
