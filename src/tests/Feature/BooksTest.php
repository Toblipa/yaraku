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
}
