<?php

namespace App\BookSearch;

use App\Book;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class BookSearch
{
    private static $ITEMS_PER_PAGE = 5;


    /**
     * Return filtered paginated items
     *
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public static function getResults(Request $request): LengthAwarePaginator
    {
        return static::apply($request)->paginate(BookSearch::$ITEMS_PER_PAGE);
    }

    /**
     * Return all filtered items
     *
     * @param Request $request
     * @return Collection
     */
    public static function getAllResults(Request $request): Collection
    {
        return static::apply($request)->get();
    }


    private static function apply(Request $request): Builder
    {
        $query = Book::query();

        static::applyDecoratorsFromRequest($request, $query);

        return $query;
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
}
