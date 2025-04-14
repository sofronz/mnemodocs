<?php
namespace App\Services;

use App\Models\User;
use App\Services\Traits\BaseTrait;

class UserService
{
    use BaseTrait;

    /**
     * UserService Constructor
     */
    public function __construct()
    {
        $this->model = new User();
    }
}
