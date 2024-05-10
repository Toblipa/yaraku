<?php

namespace Tests\Unit;

use App\Book;
use App\Converters\CsvConverter;
use PHPUnit\Framework\TestCase;

class CsvConverterTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();

        $item1 = new Book();
        $item1->title = "title1";
        $item1->author = "author1";

        $item2 = new Book();
        $item2->title = "title2";
        $item2->author = "author2";

        $item3 = new Book();
        $item3->title = "title3";
        $item3->author = "author3";

        $this->items = [
            $item1,
            $item2,
            $item3,
        ];
    }

    public function testExportBooks()
    {
        $expected_csv =
            "title, author". "\n".
            '"title1", "author1"'. "\n".
            '"title2", "author2"'. "\n".
            '"title3", "author3"'. "\n";

        $result = CsvConverter::convert($this->items);

        $this->assertEquals(
            $expected_csv,
            $result
        );
    }

    public function testExportBooksOnlyTitles()
    {
        $expected_csv =
            "title". "\n".
            '"title1"'. "\n".
            '"title2"'. "\n".
            '"title3"'. "\n";

        $result = CsvConverter::convert($this->items, ["title"]);

        $this->assertEquals(
            $expected_csv,
            $result
        );
    }
    public function testExportBooksOnlyAuthors()
    {
        $expected_csv =
            "author". "\n".
            '"author1"'. "\n".
            '"author2"'. "\n".
            '"author3"'. "\n";

        $result = CsvConverter::convert($this->items, ["author"]);

        $this->assertEquals(
            $expected_csv,
            $result
        );
    }

    public function testExportBooksNonExistentColumnThrowException()
    {
        $this->expectException(\Exception::class);

        CsvConverter::convert($this->items, ["author", "column"]);
    }
}
