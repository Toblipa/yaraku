<?php

namespace Tests\Unit;

use App\Book;
use App\BookSearch\BookSearch;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Tests\TestCase;

class BookSearchTest extends TestCase
{
    /**
     * Simple check for the provider to work
     *
     * @return void
     */
    public function testBookSearchCanBeCalled()
    {
        $request = new Request();
        BookSearch::getResults($request);
        $this->assertTrue(true);
    }

    public function testBookSearchReturnsPaginatorObject()
    {
        $request = new Request();
        $result = BookSearch::getResults($request);
        $this->assertInstanceOf(LengthAwarePaginator::class, $result);
    }

    public function testBookSearchFiltersByTitle()
    {
        // Expected Eloquent query
        $query = Book::query();
        $query->where('title', 'LIKE', "%title%");
        $queryResult = $query->get();

        // Apply filters through BookSearch class
        $request = new Request();
        $request->replace(['title' => 'title']);
        $result = BookSearch::getResults($request);

        $this->assertNotEmpty($result->items());
        $this->assertEquals($queryResult->count(), $result->total());
    }

    public function testBookSearchFiltersByTitleWithNoResults()
    {
        // Expected Eloquent query
        $query = Book::query();
        $query->where('title', 'LIKE', "%verylongstringwithnomeaning%");
        $queryResult = $query->get();

        // Apply filters through BookSearch class
        $request = new Request();
        $request->replace(['title' => 'verylongstringwithnomeaning']);
        $result = BookSearch::getResults($request);

        $this->assertEmpty($result->items());
        $this->assertEquals($queryResult->count(), $result->total());
    }

    public function testBookSearchFiltersByAuthor()
    {
        // Expected Eloquent query
        $query = Book::query();
        $query->where('author', 'LIKE', "%author%");
        $queryResult = $query->get();

        // Apply filters through BookSearch class
        $request = new Request();
        $request->replace(['author' => 'author']);
        $result = BookSearch::getResults($request);

        $this->assertNotEmpty($result->items());
        $this->assertEquals($queryResult->count(), $result->total());
    }

    public function testBookSearchFiltersByAuthorWithNoResults()
    {
        // Expected Eloquent query
        $query = Book::query();
        $query->where('author', 'LIKE', "%verylongstringwithnomeaning%");
        $queryResult = $query->get();

        // Apply filters through BookSearch class
        $request = new Request();
        $request->replace(['author' => 'verylongstringwithnomeaning']);
        $result = BookSearch::getResults($request);

        $this->assertEmpty($result->items());
        $this->assertEquals($queryResult->count(), $result->total());
    }

    public function testBookSearchOrderByTitle()
    {
        // Expected Eloquent query
        $query = Book::query();
        $query->orderBy('title', 'asc');
        $firstItem = $query->first();

        // Apply filters through BookSearch class
        $request = new Request();
        $request->replace(['sort_title' => 'asc']);
        $result = BookSearch::getResults($request);

        $this->assertEquals($firstItem, $result->first());
    }

    public function testBookSearchOrderByAuthor()
    {
        // Expected Eloquent query
        $query = Book::query();
        $query->orderBy('author', 'asc');
        $firstItem = $query->first();

        // Apply filters through BookSearch class
        $request = new Request();
        $request->replace(['sort_author' => 'asc']);
        $result = BookSearch::getResults($request);

        $this->assertEquals($firstItem, $result->first());
    }

}
