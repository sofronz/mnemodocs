<?php
namespace App\Builders\Media;

use App\Interfaces\Query;
use Illuminate\Http\Request;
use App\Services\MediaService;
use App\Builders\Media\Filters\Sort;
use App\Builders\Media\Filters\Search;
use Illuminate\Database\Eloquent\Builder;

class MediaQuery implements Query
{
    /**
     * Apply filters and conditions to the users query based on the provided request.
     *
     * @param Request $request
     *
     * @return Builder
     */
    public static function apply(Request $request): Builder
    {
        $query = app(MediaService::class)->builder();

        if ($request->has('search')) {
            $query = Search::apply($query, $request->get('search'));
        }

        if ($request->has('sort')) {
            $query = Sort::apply($query, $request->get('sort'));
        }

        return $query;
    }
}
