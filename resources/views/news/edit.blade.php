@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h2 class="text-center">Edit News</h2>
                <form method="POST" action="{{ route('news.update', $news) }}" enctype="multipart/form-data" class="form-submit">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" value="{{ $news->title }}" class="form-control" id="title" name="title" placeholder="Enter title">
                        <div class="invalid-feedback" data-error-for="title"></div>
                    </div>
                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea class="form-control" id="content" name="content" rows="4" placeholder="Enter content">{{ $news->content }}</textarea>
                        <div class="invalid-feedback" data-error-for="content"></div>
                    </div>
                    <div class="form-group">
                        <label for="image" class="d-block">Image</label>
                        <a href="{{ asset('storage/' . $news->image) }}" target="_blank">
                            <image src="{{ asset('storage/' . $news->image) }}" class="img-thumbnail mb-2" style="max-width: 200px;">
                        </a>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                        <div class="invalid-feedback" data-error-for="image"></div>
                    </div>
                    <div class="text-end">
                        <a href="{{route('news.index')}}" class="btn btn-dark">Back</a>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
