<div>
    <h1>Books List</h1>

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Title</th>
                <th scope="col">Author</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
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
