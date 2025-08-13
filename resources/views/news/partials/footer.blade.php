<link rel="stylesheet" href="{{ asset('css/footer.css') }}">
<div class="row justify-content-md-around" style="background-color: var(--bs-primary); padding: 50px; margin-top: 20px; border-radius: 20px">
    @foreach ($departmentTypes as $departmentType)
        <div class="col-6 col-md-3 mb-5">
            <p class="text-white text-bold text-center fs-4 mb-3">{{ $departmentType->name }}</p>
            <div class="row">
                @foreach ($departmentType->departments as $department)
                    @if ($department->title_short_term)
                        <div class="col-12 col-sm-6 text-center text-sm-left">
                            <a href="{{ route('departments.show', $department) }}" class="department-link"><span class="text-white">{{ $department->title_short_term }}</span></a>
                        </div>

                    @endif
                @endforeach
            </div>
        </div>

    @endforeach

</div>
