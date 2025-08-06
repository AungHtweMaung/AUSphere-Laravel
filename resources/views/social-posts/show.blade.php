@php
    use Illuminate\Support\Str;
@endphp

@extends('layouts.app', [
    'elementActive' => 'trend-posts',
])

@section('css')
    <link rel="stylesheet" href="{{ asset('css/social-posts.css') }}">
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row justify-content-center">
                <div class="col-md-9">
                    <div class="card mb-5">
                        <div class="card-body">
                            <div class="row justify-content-between align-items-center mb-3">
                                <div class="col-8 col-md-9">
                                    <img src="{{ asset('src/assets/images/default-user-image.svg') }}" width="30px;"
                                        alt=""><span class="ms-3">{{ $social_post->user->name }}</span>
                                </div>
                            </div>
                            <p class="card-text">{!! $social_post->content !!}</p>
                            <p class="card-text"><small
                                    class="text-muted">{{ $social_post->created_at->diffForHumans() }}</small></p>

                            <div class="mt-3">
                                <p class="d-inline-flex align-items-center gap-2 me-3">
                                    @if ($social_post->likes->contains('user_id', auth()->id()))
                                        <i class="fa-solid fa-heart fa-2x social-post-like-icon"
                                            data-social-post-id={{ $social_post->id }}
                                            data-like-url={{ route('social-posts.likes', $social_post->id) }}></i>
                                    @else
                                        <i class="fa-regular fa-heart fa-2x social-post-like-icon"
                                            data-social-post-id={{ $social_post->id }}
                                            data-like-url={{ route('social-posts.likes', $social_post->id) }}></i>
                                    @endif

                                    <span id="like-count-{{ $social_post->id }}">{{ $social_post->likes()->count() }}</span>
                                </p>
                                <p class="d-inline-flex align-items-center gap-2">
                                    <i class="fa-regular fa-message fa-2x"></i>
                                    <span class="comments-count">{{ $social_post->comments->count() }}</span>
                                </p>
                            </div>

                            <div class="mt-3">
                                <form action="{{ route('social-posts.comments.create', $social_post->id) }}" method="POST" class="comment-store">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="comment" class="form-label">Add a Comment</label>
                                        <textarea name="comment" id="comment" class="form-control" rows="3" placeholder="Write your comment..."
                                            required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Post Comment</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- Comment Form --}}
                    {{-- @if($social_post->comments->count()) --}}
                    <div class="card mt-4">
                        <div class="card-body">
                                <h5 class="mb-3">Comments (<span class="comments-count">{{ $social_post->comments->count() }}</span>)</h5>
                                <ul class="list-unstyled" id="comments-body">
                                @foreach($social_post->comments as $comment)
                                    <li class="mb-4 border-bottom pb-2">
                                        <div class="d-flex align-items-center mb-1">
                                            <img src="{{ asset('src/assets/images/default-user-image.svg') }}" width="24px" alt="" class="me-2">
                                            <strong>{{ $comment->user->name }}</strong>
                                            {{-- <span class="text-muted ms-2" style="font-size: 0.9em;">{{ $comment->created_at->diffForHumans() }}</span> --}}
                                        </div>
                                        <div>
                                            {{ $comment->content }}
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            </div>
                        </div>
                    </div>
                {{-- @endif --}}
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('js/social-posts.js') }}"></script>
@endpush
