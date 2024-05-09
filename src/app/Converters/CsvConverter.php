<?php

namespace App\Converters;

use App\Converters\Converter;
use Exception;

class CsvConverter implements Converter
{
    /**
     * @inheritDoc
     */
    public static function convert($items, array $columns = ['title', 'author']): string
    {
        $csv = "";
        // Add columns
        $csv .= implode(", ", $columns)."\n";
        // Add items to csv
        foreach ($items as $item) {
            $csv_item = [];
            foreach ($columns as $column) {
                if (!isset($item->{$column})) {
                    throw new Exception('Property "' . $column . '" does not exist in object "' . get_class($item) . '".');
                }
                $csv_item[] = '"'.$item->{$column}.'"';
            }
            $csv .= implode(', ', $csv_item) ."\n";
        }

        return $csv;
    }

    /**
     * @inheritDoc
     */
    public static function headers(): array
    {
        return [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=books',
        ];
    }
}
