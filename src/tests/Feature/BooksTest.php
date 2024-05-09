<?php

namespace Tests\Feature;

use App\Book;
use Mockery;
use Tests\TestCase;

class BooksTest extends TestCase
{
    /**
     * Check Books page exists.
     *
     * @return void
     */
    public function testBooksPageExists()
    {
        $response = $this->get(route('books.index'));

        $response->assertStatus(200);
    }

    public function testCanAddBook()
    {
        $book = [
            'title' => 'My test book',
            'author' => 'Great Name',
        ];

        $response = $this->post(route('books.add'), $book);

        $this->assertDatabaseHas('books', $book);
        $response->assertRedirect(route('books.index'));
    }

    public function testAddBookWithoutAuthorAndFail()
    {
        $book = [
            'title' => 'My test book',
        ];

        $response = $this->post(route('books.add'), $book);

        $this->assertDatabaseMissing('books', $book);
        $response->assertSessionHasErrors(['author']);
    }

    public function testDeleteBook()
    {
        $book = Book::whereId(1)->first();

        $response = $this->delete(route('books.delete', $book));

        $this->assertDatabaseMissing('books', $book->toArray());
        $response->assertRedirect(route('books.index'));
    }

    public function testDeleteNonExistentBookAndFail()
    {
        $fake_book = Mockery::mock('Book');

        $response = $this->delete(route('books.delete', $fake_book));

        $response->assertNotFound();
    }

    public function testEditAuthor()
    {
        $book = Book::whereId(1)->first();

        $response = $this->put(route('books.edit', $book), ["author" => "New Author"]);

        $edited_book = Book::whereId($book->id)->first();

        $this->assertEquals("New Author", $edited_book->author);
        $response->assertRedirect(route('books.index'));
    }

    public function testBooksExportXml()
    {
        $response = $this->get(route('books.export.xml',  ['title' => 'dolor']));

        $response->assertStatus(200);
    }
}
