@extends('layouts.app', [
    'elementActive' => 'news',
])
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="text-center">Create News</h2>
                    <form method="POST" action="{{ route('news.store') }}" enctype="multipart/form-data" class="form-submit">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required
                                placeholder="Enter title" >
                            <div class="invalid-feedback" data-error-for="title"></div>

                        </div>
                        <div id="content-container">
                            <div class="content-pair">
                                <div class="form-group">
                                    <div class="d-flex justify-content-between align-items-end mb-2">
                                        <label for="content">Content</label>
                                        {{-- <button type="button" class="btn btn-danger text-white"><i
                                                class="fa-regular fa-circle-xmark"></i></button> --}}
                                    </div>
                                    <textarea class="form-control content-summernote" name="news[0][content]" cols="30" rows="5" placeholder="Enter content"
                                        ></textarea>

                                    <div class="invalid-feedback" data-error-for="news[0][content]"></div>
                                </div>

                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" class="form-control" id="image" name="news[0][image]" required>
                                    <div class="invalid-feedback" data-error-for="news[0][image]"></div>
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-success text-white" id="add-more-contents">Add more
                                contents</button>
                            <a href="{{ route('news.index') }}" class="btn btn-dark">Back</a>
                            <button type="submit" class="btn btn-primary">Create</button>
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
