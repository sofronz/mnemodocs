<?php
namespace App\Interfaces;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

interface Query
{
    public static function apply(Request $request): Builder;
}
