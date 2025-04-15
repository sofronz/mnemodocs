<?php
namespace App\Builders\User;

use App\Interfaces\Query;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Builders\Filters\Trashed;
use App\Builders\User\Filters\Role;
use App\Builders\User\Filters\Sort;
use App\Builders\User\Filters\Search;
use Illuminate\Database\Eloquent\Builder;

class UserQuery implements Query
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
        $query = app(UserService::class)->builder();

        if ($request->has('search')) {
            $query = Search::apply($query, $request->get('search'));
        }

        if ($request->has('sort')) {
            $query = Sort::apply($query, $request->get('sort'));
        }

        if ($request->has('role')) {
            $query = Role::apply($query, $request->get('role'));
        }

        if ($request->has('trashed')) {
            $query = Trashed::apply($query, $request->get('trashed'));
        }

        return $query;
    }
}
