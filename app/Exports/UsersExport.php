<?php
namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::all();
    }

    /**
     * @param mixed $user
     *
     * @return array
     */
    public function map($user): array
    {
        return [
            $user->id,
            $user->name,
            $user->email,
            $user->role->name,
            $user->created_at,
        ];
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return ['ID', 'Name', 'Email', 'Role', 'Created At'];
    }
}
