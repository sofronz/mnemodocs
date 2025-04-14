<?php
namespace App\Builders\Document;

use App\Interfaces\Query;
use Illuminate\Http\Request;
use App\Services\DocumentService;
use App\Builders\Document\Filters\Sort;
use App\Builders\Document\Filters\Search;
use Illuminate\Database\Eloquent\Builder;

class DocumentQuery implements Query
{
    /**
     * Apply filters and conditions to the documents query based on the provided request.
     *
     * @param Request $request
     *
     * @return Builder
     */
    public static function apply(Request $request): Builder
    {
        $query = app(DocumentService::class)->builder();

        if ($request->has('search')) {
            $query = Search::apply($query, $request->get('search'));
        }

        if ($request->has('sort')) {
            $query = Sort::apply($query, $request->get('sort'));
        }

        return $query;
    }
}
