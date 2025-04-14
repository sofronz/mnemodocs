<?php
namespace App\Builders\Taxonomy\Filters;

use App\Interfaces\Filter;
use Illuminate\Database\Eloquent\Builder;

class Search implements Filter
{
    /**
     * @param Builder $builder
     * @param mixed $value
     *
     * @return Builder
     */
    public static function apply(Builder $builder, $value): Builder
    {
        return $builder->where(function ($query) use ($value) {
            $query->where('name', 'LIKE', '%' . $value . '%');
        });
    }
}
