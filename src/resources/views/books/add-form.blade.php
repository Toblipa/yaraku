<div>
    <h1>Add New Book</h1>
    <div class="col-md-8 order-md-1 mt-3">
        <form method="post" action="{{url('books')}}">
            @csrf <!-- {{ csrf_field() }} -->
            <div class="form-group row mb-2">
                <label for="inputTitle" class="col-sm-2 col-form-label">Title</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" aria-describedby="The title of the book" placeholder="Enter title">
                    @error('title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group row mb-2">
                <label for="inputAuthor" class="col-sm-2 col-form-label">Author</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('author') is-invalid @enderror" name="author" id="author" aria-describedby="The name of the author" placeholder="Enter author">
                    @error('author')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <button type="submit" class="mt-1 btn btn-primary">Add Book</button>
        </form>
    </div>
</div>