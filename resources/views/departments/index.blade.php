@php
    use Illuminate\Support\Str;
@endphp

@extends('layouts.app', ['elementActive' => 'departments'])

@section('content')
<div class="row">
    <div class="col-md-12">
        @include('filters.departments-filter')
        <div class="card">
            <div class="card-body">
                {{-- @dd(route('news.create')) --}}
                <a href="{{ route('departments.create') }}" class="btn btn-primary">Create</a>
                <h2 class="text-center mt-3">Departments</h2>
                <div class="table-responsive">
                    <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Department Type</th>
                            <th>Short Term</th>
                            <th>Title</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $num = ($departments->currentPage() - 1) * $departments->perPage() + 1;
                        @endphp
                        @foreach($departments as $department)
                        <tr class="">
                            <td>{{ $num }}</td>
                            <td>{{ $department->department_type->name ?? '-' }}</td>
                            <td >{{ $department->title_short_term ?? '-' }}</td>
                            <td >{{ Str::limit($department->title, 100, '...') }}</td>
                            <td>
                                <a href="{{ route('departments.show', $department->id) }}" class="btn btn-warning btn-sm text-white">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-primary btn-sm text-white">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <button data-href="{{ route('departments.destroy', $department->id) }}" class="btn btn-danger btn-sm text-white delete-data">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @php
                            $num ++;
                        @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td >
                                <div class="d-flex justify-content-center">
                                    {{ $departments->appends(request()->query())->links() }}
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
