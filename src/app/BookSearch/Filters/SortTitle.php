<?php

namespace App\BookSearch\Filters;

use Illuminate\Database\Eloquent\Builder;

class SortTitle implements Filter
{

    /**
     * @inheritDoc
     */
    public static function apply(Builder $builder, $value): Builder
    {
        return $builder->orderBy('title', $value);
    }
}
