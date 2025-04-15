<?php
namespace App\Builders\Taxonomy;

use App\Interfaces\Query;
use Illuminate\Http\Request;
use App\Builders\Filters\Trashed;
use App\Builders\Taxonomy\Filters\Sort;
use App\Builders\Taxonomy\Filters\Search;
use App\Builders\Taxonomy\Filters\Status;
use Illuminate\Database\Eloquent\Builder;
use App\Services\Taxonomy\CategoryService;
use App\Builders\Taxonomy\Filters\ParentId;

class CategoryQuery implements Query
{
    /**
     * Apply filters and conditions to the categories query based on the provided request.
     *
     * @param Request $request
     *
     * @return Builder
     */
    public static function apply(Request $request): Builder
    {
        $query = app(CategoryService::class)->builder();

        if ($request->has('search')) {
            $query = Search::apply($query, $request->get('search'));
        }
        
        if ($request->has('parent')) {
            $query = ParentId::apply($query, $request->get('parent'));
        }

        if ($request->has('sort')) {
            $query = Sort::apply($query, $request->get('sort'));
        }

        if ($request->has('status') && is_null($request->has('trashed'))) {
            $query = Status::apply($query, $request->get('status'));
        }

        if ($request->has('trashed')) {
            $query = Trashed::apply($query, $request->get('trashed'));
        }

        return $query;
    }
}
