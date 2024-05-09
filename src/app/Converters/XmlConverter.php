<?php

namespace App\Converters;

use Exception;
use SimpleXMLElement;

class XmlConverter implements Converter
{
    /**
     * @inheritDoc
     *
     * @throws Exception
     */
    public static function convert(array $items, array $columns = ['title', 'author']): string
    {
        // Create xml file
        $xml = new SimpleXMLElement("<xml/>");
        $xml_books = $xml->addChild("books");

        // Add items to xml
        foreach ($items as $item) {
            // Check if we are exporting only one property
            $xml_book = count($columns) == 1 ? $xml_books : $xml_books->addChild("book");
            foreach ($columns as $column) {
                if (!isset($item->{$column})) {
                    throw new Exception('Property "' . $column . '" does not exist in object "' . get_class($item) . '".');
                }
                $xml_book->addChild($column, $item->{$column});
            }
        }

        return $xml->asXML();
    }

    /**
     * @inheritDoc
     */
    public static function headers(): array
    {
        return [
            'Content-Type' => 'application/xml',
            'Cache-Control' => 'public',
            'Content-Description' => 'File Transfer',
            'Content-Disposition' => 'attachment; filename=books',
            'Content-Transfer-Encoding' => 'binary'];
    }
}
