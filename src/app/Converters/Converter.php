<?php

namespace App\Converters;

interface Converter
{
    /**
     * Convert given items into an exportable string.
     *
     * @param array $items
     * @param array $columns
     * @return string
     */
    public static function convert(array $items, array $columns=[]): string;

    /**
     * Get headers for Http response
     *
     * @return array
     */
    public static function headers(): array;
}
