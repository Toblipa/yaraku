<?php

namespace App\Converters;

use App\Exceptions\PropertyNotFoundException;

abstract class AbstractConverter implements Converter
{

    /**
     * @inheritDoc
     */
    abstract public static function convert(array $items, array $columns = []): string;

    /**
     * @inheritDoc
     */
    abstract public static function headers(): array;

    protected static function checkItemProperty($item, $property): void {
        if (!isset($item->{$property})) {
            throw new PropertyNotFoundException('Property "' . $property . '" does not exist in object "' . get_class($item) . '".');
        }
    }
}
