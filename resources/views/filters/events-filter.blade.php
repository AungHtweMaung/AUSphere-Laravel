<div class="row justify-content-end mb-3">
    <div class="col-12">
        <form action="{{ url()->full() }}" method="GET">
            <div class="row justify-content-end">
                <div class="col-md-4 mb-2">
                    <label for="searchStartDate">Start Date</label>
                    <input type="date" value="{{ request('searchStartDate') }}" class="form-control form-control-sm date-picker" id="searchStartDate" name="searchStartDate" placeholder="Start date">
                </div>
                <div class="col-md-4 mb-2">
                    <label for="searchEndDate">End Date</label>
                    <input type="date" value="{{ request('searchEndDate') }}" class="form-control form-control-sm date-picker" id="searchEndDate" name="searchEndDate" placeholder="End date">
                </div>
                <div class="col-md-4 mb-2">
                    <div class="">
                        <label for="searchTitle">Title</label>
                        <input type="text" value="{{ request('searchTitle') }}" class="form-control form-control-sm"  id="searchTitle" name="searchTitle" placeholder="Enter title">
                    </div>
                </div>

            </div>
            <div class="row justify-content-end">
                <div class="col-4">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('events.index') }}" class="btn btn-danger text-white me-2">Reset</a>
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
