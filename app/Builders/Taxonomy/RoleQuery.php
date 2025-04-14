<?php
namespace App\Builders\Taxonomy;

use App\Interfaces\Query;
use Illuminate\Http\Request;
use App\Services\RoleService;
use App\Builders\Taxonomy\Filters\Sort;
use App\Builders\Taxonomy\Filters\Search;
use Illuminate\Database\Eloquent\Builder;
use App\Builders\Taxonomy\Filters\ParentId;

class RoleQuery implements Query
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
        $query = app(RoleService::class)->builder();

        if ($request->has('search')) {
            $query = Search::apply($query, $request->get('search'));
        }
        
        if ($request->has('parent')) {
            $query = ParentId::apply($query, $request->get('parent'));
        }

        if ($request->has('sort')) {
            $query = Sort::apply($query, $request->get('sort'));
        }

        return $query;
    }
}
