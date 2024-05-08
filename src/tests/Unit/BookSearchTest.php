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
    public function testBookSearchCanBeCalled() {
        $request = new Request();
        BookSearch::apply($request);
        $this->assertTrue(true);
    }

    public function testBookSearchReturnsPaginatorObject() {
        $request = new Request();
        $result = BookSearch::apply($request);
        $this->assertInstanceOf(LengthAwarePaginator::class, $result);
    }

    public function testBookSearchFiltersByTitle(){
        // Expected Eloquent query
        $query = Book::query();
        $query->where('title', 'LIKE', "%title%");
        $queryResult = $query->get();

        // Apply filters through BookSearch class
        $request = new Request();
        $request->replace(['title' => 'title']);
        $result = BookSearch::apply($request);

        $this->assertIsArray($result->items());
        $this->assertEquals($queryResult->count(), $result->count());
        $this->assertEquals($queryResult->all(), $result->items());
    }

    public function testBookSearchOrderByTitle(){
        // Expected Eloquent query
        $query = Book::query();
        $query->orderBy('title', 'asc');
        $firstItem = $query->first();

        // Apply filters through BookSearch class
        $request = new Request();
        $request->replace(['sort_title' => 'asc']);
        $result = BookSearch::apply($request);

        $this->assertIsArray($result->items());
        $this->assertEquals($firstItem, $result->first());
    }

    public function testBookSearchOrderByAuthor(){
        // Expected Eloquent query
        $query = Book::query();
        $query->orderBy('author', 'asc');
        $firstItem = $query->first();

        // Apply filters through BookSearch class
        $request = new Request();
        $request->replace(['sort_author' => 'asc']);
        $result = BookSearch::apply($request);

        $this->assertIsArray($result->items());
        $this->assertEquals($firstItem, $result->first());
    }

}
