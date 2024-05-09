<div>
    <h1>Books List</h1>

    <!-- Export Button -->
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                Export
            </button>
            <ul class="dropdown-menu">
                <li><button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exportModal" data-bs-export="csv">CSV</button></li>
                <li><button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exportModal" data-bs-export="xml">XML</button></li>
            </ul>
        </div>
    </div>

    <!-- Search Bar -->
    @include('books/search-bar')

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
            <tr class="align-middle">
                <td>{{ $book->title }}</td>
                <td>
                    {{ $book->author }}
                    <button type="button" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#editModal"
                            data-bs-id="{{$book->id}}" data-bs-author="{{$book->author}}" data-bs-title="{{$book->title}}">
                        @svg('solid/pen-to-square')
                    </button>
                </td>
                <td class="text-center align-items-center">
                    <form class="m-0" action="{{ route('books.delete', $book) }}" method="POST">
                        @csrf  <!-- {{ csrf_field() }} -->
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

    <!-- Modals -->
    @include('books/edit-modal')
    @include('books/export-modal')
</div>
