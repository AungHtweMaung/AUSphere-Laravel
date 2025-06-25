@php
    use Illuminate\Support\Str;
@endphp

@extends('layouts.app', [
    'elementActive' => 'events'
    ])
@section('content')
<div class="row">
    <div class="col-md-12">
        @include('filters.events-filter')
        <div class="card">
            <div class="card-body">
                {{-- @dd(route('events.create')) --}}
                <a href="{{ route('events.create') }}" class="btn btn-primary">Create</a>
                <h2 class="text-center mt-3">Event List</h2>
                <div class="table-responsive">
                    <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="col-1">No</th>
                            <th class="col-2">Title</th>
                            <th class="col-4">Content</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $num = ($events->currentPage() - 1) * $events->perPage() + 1;
                        @endphp
                        @foreach($events as $item)
                        <tr>
                            <td>{{ $num }}</td>
                            <td >{{ Str::limit($item->title, 50, '...') }}</td>
                            <td class="">{!! Str::limit($item->content, 50, '...') !!}</td>
                            <td>
                                @if($item->image && file_exists(public_path('storage/' . $item->image)))
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="img-thumbnail" style="width: 100px; height: auto;">
                                @else
                                    No Image
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('events.show', $item->id) }}" class="btn btn-warning btn-sm text-white">
                                    <i class="fa-regular fa-eye"></i>
                                </a>
                                <a href="{{ route('events.edit', $item->id) }}" class="btn btn-primary btn-sm text-white">
                                    <i class="fa-regular fa-edit"></i>
                                </a>
                                <button data-href="{{ route('events.destroy', $item->id) }}" class="btn btn-danger btn-sm text-white delete-data">
                                    <i class="fa-regular fa-trash-can"></i>
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
                                    {{ $events->links() }}
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
