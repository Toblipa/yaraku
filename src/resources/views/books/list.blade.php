<div>
    <h1>Books List</h1>

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">
                    Title
                    @if( request()->get('sortBy') === "title" && request()->get('sort') ==="desc" )
                        <a href="?sortBy=title&sort=asc">sort a</a>
                    @else
                        <a href="?sortBy=title&sort=desc">sort d</a>
                    @endif
                </th>
                <th scope="col">
                    Author
                    @if( request()->get('sortBy') === "author" && request()->get('sort') ==="desc" )
                        <a href="?sortBy=author&sort=asc">sort a</a>
                    @else
                        <a href="?sortBy=author&sort=desc">sort d</a>
                    @endif
                </th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
        @if ($books->count() == 0)
            <tr>
                <td colspan="3">No books to display.</td>
            </tr>
        @endif
        @foreach($books as $book)
            <tr scope="row">
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td class="text-danger">Delete</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <!-- Pagination Links -->
    <div>
        {{ $books->links("pagination::bootstrap-4") }}
    </div>
</div>
