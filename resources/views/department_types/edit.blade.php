@extends('layouts.app', ['elementActive' => 'department-types'])
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h2 class="text-center">Edit Department Type</h2>
                <form  method="POST" action="{{ route('department-types.update', $department_type->id) }}" class="form-submit">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" value="{{ $department_type->name }}"  id="name" name="name" placeholder="Enter name" required>
                        <div class="invalid-feedback" data-error-for="name"></div>

                    </div>
                    <div class="text-end">
                        <a href="{{route('department-types.index')}}" class="btn btn-dark">Back</a>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

