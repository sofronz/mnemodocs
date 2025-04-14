<?php
namespace App\Services;

use App\Models\Taxonomy\Role;
use App\Services\Traits\BaseTrait;

class DocumentService
{
    use BaseTrait;

    /**
     * DocumentService Constructor
     */
    public function __construct()
    {
        $this->model = new Role();
    }
}
