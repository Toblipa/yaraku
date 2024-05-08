<?php

namespace App\BookSearch\Filters;

use Illuminate\Database\Eloquent\Builder;

class SortAuthor implements Filter
{

    /**
     * @inheritDoc
     */
    public static function apply(Builder $builder, $value): Builder
    {
        return $builder->orderBy('author', $value);
    }
}
