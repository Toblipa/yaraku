<?php

namespace App\Converters;

use Exception;

class CsvConverter extends AbstractConverter
{
    private static $separator = ", ";

    /**
     * @inheritDoc
     * @throws Exception
     */
    public static function convert(array $items, array $columns = ['title', 'author']): string
    {
        // Initialize resource
        $result = implode(self::$separator, $columns) . "\n";

        foreach ($items as $item) {
            // Add row
            $csv_item = [];
            foreach ($columns as $column) {
                self::checkItemProperty($item, $column);
                // Put into quotes to avoid problems in case the string has a comma
                $csv_item[] = '"' . $item->{$column} . '"';
            }
            // Add item
            $result .= implode(self::$separator, $csv_item) . "\n";
        }

        return $result;
    }

    /**
     * @inheritDoc
     */
    public static function headers(): array
    {
        return [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=books.csv',
        ];
    }
}
