<?php
namespace App\Services\Taxonomy;

use App\Models\Taxonomy\Category;
use App\Services\Traits\BaseTrait;

class CategoryService
{
    use BaseTrait;

    /**
     * CategoryService Constructor
     */
    public function __construct()
    {
        $this->model = new Category();
    }
}
