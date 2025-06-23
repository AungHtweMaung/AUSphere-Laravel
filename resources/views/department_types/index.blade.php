@php
    use Illuminate\Support\Str;
@endphp

@extends('layouts.app', ['elementActive' => 'department-types'])

@section('content')
<div class="row">
    <div class="col-md-12">
        @include('filters.department-type-filter')
        <div class="card">
            <div class="card-body">
                {{-- @dd(route('news.create')) --}}
                <a href="{{ route('department-types.create') }}" class="btn btn-primary">Create</a>
                <h2 class="text-center mt-3">Department Types</h2>
                <div class="table-responsive">
                    <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="col-4">No</th>
                            <th class="col-5">Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $num = ($department_types->currentPage() - 1) * $department_types->perPage() + 1;
                        @endphp
                        @foreach($department_types as $department_type)
                        <tr>
                            <td>{{ $num }}</td>
                            <td >{{ Str::limit($department_type->name, 100, '...') }}</td>
                            <td>
                                <a href="{{ route('department-types.edit', $department_type->id) }}" class="btn btn-primary btn-sm text-white">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <button data-href="{{ route('department-types.destroy', $department_type->id) }}" class="btn btn-danger btn-sm text-white delete-data">
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
                                    {{ $department_types->appends(request()->query())->links() }}
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
