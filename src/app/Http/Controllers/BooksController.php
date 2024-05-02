<?php

namespace App\Http\Controllers;

use App\Book;
use App\Http\Requests\StoreBookRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): View
    {
        $sortBy = $request->input('sortBy', 'title');
        $sort = $request->input('sort', 'desc');

        $books = Book::orderBy(
            $sortBy,
            $sort
        )->paginate(5);

        // Append sorting query to pagination links
        $books->appends(['sortBy' => $sortBy]);
        $books->appends(['sort' => $sort]);

        return view('books.index', ['books' => $books]);
    }

    /**
     *  Store a newly created resource in storage.
     *
     * @param StoreBookRequest $request
     * @return RedirectResponse
     */
    public function store(StoreBookRequest $request): RedirectResponse
    {
        Book::create($request->all());

        return redirect('/books');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        // TODO
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        // TODO
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        // TODO
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        // TODO
    }
}
