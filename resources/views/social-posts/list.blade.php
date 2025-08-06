@foreach ($socialPosts as $post)
    <div class="card mb-5">
        <div class="card-body">
            <div class="row justify-content-between align-items-center mb-3">
                <div class="col-8 col-md-9">
                    <img src="{{ asset('src/assets/images/default-user-image.svg') }}" width="30px;" alt=""><span
                        class="ms-3">{{ $post->user->name }}</span>
                </div>
                @if (url()->current() != route('social-posts.index'))
                    <div class="col-4 col-md-3 me-md-5 me-1 social-posts-menu dropdown ">
                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-ellipsis fa-3x social-posts-menu-icon text-black"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li>
                                <a class="dropdown-item"
                                    href="{{ route('social-posts.create', [$profile->id, $post->id]) }}">Edit</a>
                            </li>
                            {{-- <li><a class="dropdown-item" data-href="{{ route('social-posts.destroy', [$profile->id, $post->id]) }}" class="delete-data">Delete</a></li> --}}
                            <li>
                                <button data-href="{{ route('social-posts.destroy', [$profile->id, $post->id]) }}"
                                    class="dropdown-item delete-data">
                                    Delete
                                </button>
                            </li>
                        </ul>
                    </div>
                @endif



            </div>
            <p class="card-text">{!! $post->content !!}</p>
            <p class="card-text"><small class="text-muted">{{ $post->created_at->diffForHumans() }}</small></p>

            <div class="mt-3">
                <p class="d-inline-flex align-items-center gap-2 me-3">
                    @if ($post->likes->contains('user_id', auth()->id()))
                        <i class="fa-solid fa-heart fa-2x social-post-like-icon"
                            data-social-post-id="{{ $post->id }}"
                            data-like-url="{{ route('social-posts.likes', $post->id) }}"></i>
                    @else
                        <i class="fa-regular fa-heart fa-2x social-post-like-icon"
                            data-social-post-id="{{ $post->id }}"
                            data-like-url="{{ route('social-posts.likes', $post->id) }}"></i>
                    @endif
                    <span id="like-count-{{ $post->id }}">{{ $post->likes()->count() }}</span>
                </p>
                <p class="d-inline-flex align-items-center gap-2">
                    <a href="{{ route('social-posts.show', [$post->id]) }}" class="text-decoration-none text-dark">
                        <i class="fa-regular fa-message fa-2x"></i>
                    </a>
                    <span class="comments-count">{{ $post->comments->count() }}</span>
                </p>
            </div>
        </div>
    </div>
@endforeach
