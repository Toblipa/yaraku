<?php

namespace App\BookSearch\Filters;

use Illuminate\Database\Eloquent\Builder;

class Author implements Filter
{

    /**
     * @inheritDoc
     */
    public static function apply(Builder $builder, $value): Builder
    {
        return $builder->where('author', 'LIKE', "%{$value}%");
    }
}
