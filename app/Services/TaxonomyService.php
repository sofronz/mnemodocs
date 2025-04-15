<?php
namespace App\Services;

use App\Models\Taxonomy;
use App\Services\Traits\BaseTrait;

class TaxonomyService
{
    use BaseTrait;

    /**
     * TaxonomyService Constructor
     */
    public function __construct()
    {
        $this->model = new Taxonomy();
    }
}
