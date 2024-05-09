<div>
    <h1>Books List</h1>

    <!-- Search Bar -->
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

    <!-- Books Table -->
    <table class="table table-hover">
        <!-- Table columns with sort -->
        <thead>
            <tr>
                <th scope="col">
                    Title
                    @if( request()->has('sort_title') && request()->get('sort_title') === "asc" )
                        <a href="{{request()->fullUrlWithQuery(['sort_title' => 'desc', 'sort_author' => null])}}">
                            @svg('solid/sort-up')
                        </a>
                    @else
                        <a href="{{request()->fullUrlWithQuery(['sort_title' => 'asc', 'sort_author' => null])}}">
                            @svg('solid/sort-down')
                        </a>
                    @endif
                </th>
                <th scope="col">
                    Author
                    @if( request()->has('sort_author') && request()->get('sort_author') === "asc" )
                        <a href="{{request()->fullUrlWithQuery(['sort_author' => 'desc', 'sort_title' => null])}}">
                            @svg('solid/sort-up')
                        </a>
                    @else
                        <a href="{{request()->fullUrlWithQuery(['sort_author' => 'asc', 'sort_title' => null])}}">
                            @svg('solid/sort-down')
                        </a>
                    @endif
                </th>
                <th scope="col"></th>
            </tr>
        </thead>

        <!-- Rows with books information -->
        <tbody>
        @if ($books->count() == 0)
            <tr>
                <td colspan="3">No books to display.</td>
            </tr>
        @endif
        @foreach($books as $book)
            <tr>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td class="d-flex justify-content-center">
                    <form action="{{ route('books.delete', $book) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button
                            type="submit"
                            class="btn btn-danger"
                            onclick="return confirm('{{ sprintf('Are you sure you want to delete %s by %s?', $book->title, $book->author) }}')"
                        >
                            @svg('solid/trash-can')
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div>
        {{ $books->appends(request()->all())->links("pagination::bootstrap-4") }}
    </div>
    <!-- Deletion Alert -->
    @if(Session::has('deleted'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Book deleted.</strong>
            <span>{{ Session::get('message', '') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>
