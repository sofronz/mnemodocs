<?php
namespace App\Exports;

use App\Models\Taxonomy\Role;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class RolesExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Role::all();
    }

    /**
     * @param mixed $role
     *
     * @return array
     */
    public function map($role): array
    {
        return [
            $role->id,
            $role->name,
            $role->description,
            $role->status == 1 ? 'Active' : 'InActive',
            $role->created_at,
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
