@extends('layouts.app', ['elementActive' => 'department-types'])
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h2 class="text-center">Create Department Type</h2>
                <form  method="POST" action="{{ route('department-types.store') }}" class="form-submit">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control"  id="name" name="name" placeholder="Enter name" required>
                        <div class="invalid-feedback" data-error-for="name"></div>

                    </div>
                    <div class="text-end">
                        <a href="{{route('department-types.index')}}" class="btn btn-dark">Back</a>

                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

