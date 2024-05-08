<?php

namespace Tests\Feature;

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
        // Arrange
        $book = [
            'title' => 'This is a title',
            'author' => 'A Great Author',
        ];

        // Act
        $response = $this->post('/books/add', $book);

        // Assert
        $this->assertDatabaseHas('books', $book);
        $response->assertRedirect('/books');
    }

    public function testAddBookWithoutAuthorAndFail()
    {
        // Arrange
        $book = [
            'title' => 'This is a title',
        ];

        // Act
        $response = $this->post('/books/add', $book);

        // Assert
        $this->assertDatabaseMissing('books', $book);
        $response->assertSessionHasErrors(['author']);
    }
}
