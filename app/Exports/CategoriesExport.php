<?php
namespace App\Exports;

use App\Models\Taxonomy\Category;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class CategoriesExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Category::all();
    }

    /**
     * @param mixed $category
     *
     * @return array
     */
    public function map($category): array
    {
        return [
            $category->id,
            $category->name,
            $category->description,
            $category->status == 1 ? 'Active' : 'InActive',
            $category->created_at,
        ];
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return ['ID', 'Name', 'Description', 'Status', 'Created At'];
    }
}
