<?php

namespace Tests\Feature;

use App\Book;
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
        $response = $this->get('/books');

        $response->assertStatus(200);
    }

    public function testCanAddBook()
    {
        $book = [
            'title' => 'My test book',
            'author' => 'Great Name',
        ];

        $response = $this->post('/books/add', $book);

        $this->assertDatabaseHas('books', $book);
        $response->assertRedirect('/books');
    }

    public function testAddBookWithoutAuthorAndFail()
    {
        $book = [
            'title' => 'My test book',
        ];

        $response = $this->post('/books/add', $book);

        $this->assertDatabaseMissing('books', $book);
        $response->assertSessionHasErrors(['author']);
    }

    public function testDeleteBook()
    {
        $book = Book::whereId(1)->first();

        $response = $this->delete('/books/delete/' . $book->id);

        $this->assertDatabaseMissing('books', $book->toArray());
        $response->assertRedirect('/books');
    }

    public function testDeleteNonExistentBookAndFail()
    {
        $response = $this->delete('/books/delete/45');

        $response->assertNotFound();
    }
}
