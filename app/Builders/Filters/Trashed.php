<?php
namespace App\Builders\Filters;

use App\Interfaces\Filter;
use Illuminate\Database\Eloquent\Builder;

class Trashed implements Filter
{
    /**
     * @param Builder $builder
     * @param mixed $value
     *
     * @return Builder
     */
    public static function apply(Builder $builder, $value): Builder
    {
        return (bool) $value ? $builder->onlyTrashed() : $builder;
    }
}
