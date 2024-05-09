<?php

namespace Tests\Unit;

use App\Book;
use App\Converters\XmlConverter;
use PHPUnit\Framework\TestCase;

class XmlConverterTest extends TestCase
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
        $expected_xml =
            "<books>".
                "<book><title>title1</title><author>author1</author></book>".
                "<book><title>title2</title><author>author2</author></book>".
                "<book><title>title3</title><author>author3</author></book>".
            "</books>";

        $result = XmlConverter::convert($this->items);

        $this->assertStringContainsString(
            $expected_xml,
            $result
        );
    }

    public function testExportBooksOnlyTitles()
    {
        $expected_xml =
            "<books>".
                "<title>title1</title>".
                "<title>title2</title>".
                "<title>title3</title>".
            "</books>";

        $result = XmlConverter::convert($this->items, ["title"]);

        $this->assertStringContainsString(
            $expected_xml,
            $result
        );
    }
    public function testExportBooksOnlyAuthors()
    {
        $expected_xml =
            "<books>".
                "<author>author1</author>".
                "<author>author2</author>".
                "<author>author3</author>".
            "</books>";

        $result = XmlConverter::convert($this->items, ["author"]);

        $this->assertStringContainsString(
            $expected_xml,
            $result
        );
    }

    public function testExportBooksNonExistentColumnThrowException()
    {
        $this->expectException(\Exception::class);

        XmlConverter::convert($this->items, ["author", "column"]);
    }
}
