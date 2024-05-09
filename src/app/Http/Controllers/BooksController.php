<?php

namespace App\Http\Controllers;

use App\Book;
use App\BookSearch\BookSearch;
use App\Converters\CsvConverter;
use App\Converters\XmlConverter;
use App\Http\Requests\EditBookRequest;
use App\Http\Requests\StoreBookRequest;
use Exception;
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
        $books = BookSearch::getResults($request);

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

        return redirect('/books')->with('success', true)->with('message','Book added successfully.');
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
     * @param  EditBookRequest  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(EditBookRequest $request, Book $book): RedirectResponse
    {
        $book->update($request->all());

        return redirect('/books')->with('success', true)->with('message','Book updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book): RedirectResponse
    {
        try {
            $book->delete();
        } catch (Exception $e){
            $message = $e->getMessage();
            return redirect('/books')
                ->with('error', $message);
        }

        return redirect('/books')
            ->with('deleted', true)
            ->with('message', sprintf(
                '"%s" by "%s" has been deleted successfully.',
                $book->title,
                $book->author
            ));
    }

    public function export(Request $request, string $type) {
        switch ($type) {
            case "csv":
                $converterClass = CsvConverter::class;
                break;
            case "xml":
                $converterClass = XmlConverter::class;
                break;
            default:
                return redirect('/books')
                    ->with('error', 'Export type not supported');
        }

        $books = BookSearch::getAllResults($request)->all();

        try {
            $result = $request->has('columns') ?
                $converterClass::convert($books, $request->get('columns')) : $converterClass::convert($books);

        } catch (Exception $e) {
            $message = $e->getMessage();
            return redirect('/books')
                ->with('error', $message);
        }

        return response($result, 200, $converterClass::headers());
    }
}
