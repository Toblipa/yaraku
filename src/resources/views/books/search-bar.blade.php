<ul class="nav nav-tabs">
    <li class="nav-item">
        <button class="nav-link {{!request()->has("author") ? "active" : ""}}" data-bs-toggle="tab" data-bs-target="#search1">
            Title
        </button>
    </li>
    <li class="nav-item">
        <button class="nav-link {{request()->has("author") ? "active" : ""}}" data-bs-toggle="tab" data-bs-target="#search2">
            Author
        </button>
    </li>
</ul>
<div class="tab-content">
    <div id="search1" class="tab-pane {{!request()->has("author") ? "active" : ""}} input-group mb-3" role="tabpanel">
        <form action="{{ route('books.index') }}" method="GET">
            <div class="input-group mb-3">
                <input id="title" name="title" type="text" class="form-control" placeholder="Book title"
                       aria-label="Book title" value="{{ request()->get('title') }}">
                <button class="btn btn-outline-secondary" type="submit">@svg('solid/magnifying-glass') Search</button>
                <button class="btn btn-outline-secondary" type="button" onclick="location.href='{{ route('books.index') }}'">@svg('solid/delete-left') Clear</button>
            </div>
        </form>
    </div>
    <div id="search2" class="tab-pane {{request()->has("author") ? "active" : ""}} input-group mb-3" role="tabpanel">
        <form action="{{ route('books.index') }}" method="GET">
            <div class="input-group mb-3">
                <input id="author" name="author" type="text" class="form-control" placeholder="Author's name"
                       aria-label="Author's name" value="{{ request()->get('author') }}">
                <button class="btn btn-outline-secondary" type="submit">@svg('solid/magnifying-glass') Search</button>
                <button class="btn btn-outline-secondary" type="button" onclick="location.href='{{ route('books.index') }}'">@svg('solid/delete-left') Clear</button>
            </div>
        </form>
    </div>
</div>
