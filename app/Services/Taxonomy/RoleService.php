<?php
namespace App\Services\Taxonomy;

use App\Models\Taxonomy\Role;
use App\Services\Traits\BaseTrait;

class RoleService
{
    use BaseTrait;

    /**
     * RoleService Constructor
     */
    public function __construct()
    {
        $this->model = new Role();
    }
}
