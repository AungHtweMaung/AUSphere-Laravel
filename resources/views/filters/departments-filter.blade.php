<div class="row justify-content-end mb-3">
    <div class="col-12">
        <form action="{{ url()->full() }}" method="GET">
            <div class="row justify-content-end gap-2">
                <div class="col-md-4">
                    <select class="form-control select2" id="search_department_type_id" name="search_department_type_id" required>
                        <option value="">Choose Department Type</option>
                        @foreach($department_types as $department_type)
                            <option value="{{ $department_type->id }}" {{ $department_type->id == request('search_department_type_id') ? 'selected' : '' }}>{{ $department_type->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <div class="form-group gap-3">
                        <input type="text" value="{{ request('searchKey') }}" class="form-control form-control-sm"  id="searchKey" name="searchKey" placeholder="Enter short term or title...">
                    </div>
                </div>
            </div>
            <div class="row justify-content-end">
                <div class="col-4">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('departments.index') }}" class="btn btn-danger text-white me-2">Reset</a>
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
