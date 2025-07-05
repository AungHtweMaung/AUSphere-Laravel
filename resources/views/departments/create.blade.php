@extends('layouts.app', [
    'elementActive' => 'departments'
    ])

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h2 class="text-center">Create Department</h2>
                <form  method="POST" action="{{ route('departments.store') }}" enctype="multipart/form-data" class="form-submit">
                    @csrf
                    <div class="form-group">
                        <label for="department_type_id">Department <span class="text-danger">*</span></label>
                        <select class="form-control select2" id="department_type_id" name="department_type_id" required>
                            <option value="">Choose Department Type</option>
                            @foreach($department_types as $department_type)
                                <option value="{{ $department_type->id }}">{{ $department_type->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback" data-error-for="department_type_id"></div>
                    </div>
                    <div class="form-group">
                        <label for="title_short_term">Title Short Term</label>
                        <input type="text" class="form-control"  id="title_short_term" name="title_short_term" placeholder="Enter Short Term">
                        <div class="invalid-feedback" data-error-for="title_short_term"></div>
                    </div>

                    <div class="form-group">
                        <label for="title">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control"  id="title" name="title" placeholder="Enter title" required>
                        <div class="invalid-feedback" data-error-for="title"></div>
                    </div>
                    <div class="form-group">
                        <label for="content">Content <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="content" id="content" cols="30" rows="5" placeholder="Enter content" required></textarea>
                        <div class="invalid-feedback" data-error-for="content"></div>
                    </div>

                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                        <div class="invalid-feedback" data-error-for="image"></div>
                    </div>
                    <div class="text-end">
                        <a href="{{route('news.index')}}" class="btn btn-dark">Back</a>

                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>





        </div>
    </div>
</div>
@endsection

