<?php
namespace Database\Seeders;

use App\Models\Taxonomy;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class TaxonomiesTableSeeder extends Seeder
{
    /**
     * @var array
     */
    protected $categories = [
        [
            'name'     => 'Roles',
            'slug'     => 'roles',
            'children' => [
                [
                    'name' => 'User',
                ],
                [
                    'name' => 'Administrator',
                ],
            ],
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Taxonomy::truncate();

        foreach ($this->categories as $key => $value) {
            $children = $value['children'] ?? [];
            
            unset($value['children']);
            $taxonomy = Taxonomy::create($value);

            foreach ($children as $key => $child) {
                Taxonomy::create(array_merge(
                    [
                        'parent_id' => $taxonomy->id,
                        'slug'      => $taxonomy->slug . '-' . Str::slug($child['name']),
                    ],
                    $child
                ));
            }
        }
    }
}
