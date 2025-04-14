<?php
namespace Database\Seeders;

use App\Models\User;
use App\Services\RoleService;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleUser  = app(RoleService::class)->find('slug', 'roles-user');
        $roleAdmin = app(RoleService::class)->find('slug', 'roles-administrator');

        User::factory(1)->create([
            'role_id' => $roleUser->id,
        ]);

        User::factory(1)->create([
            'role_id' => $roleAdmin->id,
        ]);
    }
}
