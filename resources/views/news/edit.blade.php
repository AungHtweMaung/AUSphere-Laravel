@extends('layouts.app', ['elementActive' => 'news'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="text-center">Edit News</h2>

                    <form method="POST" action="{{ route('news.update', $news->id) }}" enctype="multipart/form-data"
                        class="form-submit">
                        @csrf
                        @method('PUT')

                        {{-- Title --}}
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" value="{{ old('title', $news->title) }}" class="form-control"
                                name="title" id="title">
                            <div class="invalid-feedback" data-error-for="title"></div>
                        </div>

                        {{-- content container start --}}
                        <div id="content-container">
                            {{-- Loop Through Multiple Contents and Images --}}
                            @foreach ($news->newsContents as $index => $item)
                                <div class="content-pair border rounded p-3 mb-4">
                                <input type="hidden" name="news[{{ $index }}][id]" value="{{ $item->id }}">
                                    <h5>Content Set #{{ $index + 1 }}</h5>
                                    {{-- Content --}}
                                    <div class="form-group">
                                        <div class="d-flex justify-content-between align-items-end mb-2">
                                            <label>Content</label>
                                            @if ($index > 0)
                                                <button type="button" class="btn btn-danger text-white remove-pair"><i
                                                    class="fa-regular fa-circle-xmark"></i></button>
                                            @endif
                                        </div>
                                        <textarea class="form-control content-summernote" name="news[{{ $index }}][content]"
                                            id="content_{{ $index }}" rows="4">{{ old("news.{$index}.content", $item->content) }}</textarea>
                                        <div class="invalid-feedback" data-error-for="news[{{ $index }}][content]">
                                        </div>
                                    </div>

                                    {{-- Existing Image --}}
                                    @if ($item->image)
                                        <div class="mb-2">
                                            <a href="{{ asset('storage/' . $item->image) }}" target="_blank">
                                                <img src="{{ asset('storage/' . $item->image) }}" class="img-thumbnail"
                                                    style="max-width: 200px;">
                                            </a>
                                        </div>
                                    @endif

                                    {{-- Image Upload --}}
                                    <div class="form-group">
                                        <label for="image_{{ $index }}">Replace Image</label>
                                        <input type="file" class="form-control" name="news[{{ $index }}][image]"
                                            id="image_{{ $index }}" accept="image/*">
                                        <div class="invalid-feedback" data-error-for="news[{{ $index }}][image]">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {{-- content container end --}}

                        <div class="text-end">
                            <button type="button" class="btn btn-success text-white" id="add-more-contents">Add more
                                contents</button>
                            <a href="{{ route('news.index') }}" class="btn btn-dark">Back</a>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('js/news.js') }}"></script>
@endpush
