<?php

namespace App\BookSearch;

use App\Book;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class BookSearch
{
    private static $ITEMS_PER_PAGE = 5;

    public static function apply(Request $request): LengthAwarePaginator
    {
        $query = Book::query();

        static::applyDecoratorsFromRequest($request, $query);

        return self::getResults($query);
    }

    private static function applyDecoratorsFromRequest(Request $request, Builder $query): void
    {
        foreach ($request->all() as $filterName => $value) {
            $decorator = static::createFilterDecorator($filterName);

            if (static::isValidDecorator($decorator)) {
                $query = $decorator::apply($query, $value);
            }
        }
    }

    private static function createFilterDecorator($name): string
    {
        return __NAMESPACE__ . '\\Filters\\' . Str::studly($name);
    }

    private static function isValidDecorator($decorator): bool
    {
        return class_exists($decorator);
    }

    private static function getResults(Builder $query): LengthAwarePaginator
    {
        return $query->paginate(BookSearch::$ITEMS_PER_PAGE);
    }
}
