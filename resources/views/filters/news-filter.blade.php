<div class="row justify-content-end">
    <div class="col-md-4">
        <form action="{{ url()->full() }}" method="GET">
            <div class="form-group gap-3">
                <input type="text" value="{{ request('searchKey') }}" class="form-control form-control-sm"  id="searchKey" name="searchKey" placeholder="Search...">
                <div class="mt-3 text-end">
                    <a href="{{ route('news.index') }}" class="btn btn-danger text-white">Reset</a>
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>
    </div>
</div>
