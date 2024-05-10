<?php

namespace App\Converters;

use Exception;
use SimpleXMLElement;

class XmlConverter extends AbstractConverter
{
    /**
     * @inheritDoc
     *
     * @throws Exception
     */
    public static function convert(array $items, array $columns = ['title', 'author']): string
    {
        // Initialize resource
        $result = new SimpleXMLElement("<xml/>");
        // Add row
        $xml_items = $result->addChild("books");

        foreach ($items as $item) {
            // Check if we are exporting only one property
            $xml_item = count($columns) == 1 ? $xml_items : $xml_items->addChild("book");
            foreach ($columns as $column) {
                self::checkItemProperty($item, $column);
                // Add item
                $xml_item->addChild($column, $item->{$column});
            }
        }

        return $result->asXML();
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
            'Content-Disposition' => 'attachment; filename=books.xml',
            'Content-Transfer-Encoding' => 'binary'];
    }
}
