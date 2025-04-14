<?php
namespace App\Models\Scopes;

use App\Models\Taxonomy;
use App\Models\Taxonomy\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;

class CategoryScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param Builder $builder
     * @param Model $model
     *
     * @return void
     */
    public function apply(Builder $builder, Model $model): void
    {
        $category = Taxonomy::whereSlug(Category::$rootSlug)->first();
        $builder->where('parent_id', $category->id);
    }
}
