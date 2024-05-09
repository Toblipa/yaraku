<div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="exportModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="modal-form" action="{{ route('books.export', [":type"]) }}" method="GET">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exportModalLabel">Export</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-check">
                        <input name="columns[]" class="form-check-input" type="checkbox" value="title" id="col_title" checked>
                        <label class="form-check-label" for="col_title">
                            Title
                        </label>
                    </div>
                    <div class="form-check">
                        <input name="columns[]" class="form-check-input" type="checkbox" value="author" id="col_author" checked>
                        <label class="form-check-label" for="col_author">
                            Author
                        </label>
                    </div>
                    @foreach (request()->all() as $key=>$value)
                        <input type="hidden" name="{{$key}}" value="{{$value}}" />
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Export</button>
                </div>
            </form>
        </div>
    </div>
</div>
