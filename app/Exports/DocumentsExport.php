<?php
namespace App\Exports;

use App\Models\Document;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class DocumentsExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Document::all();
    }

    /**
     * @param mixed $document
     *
     * @return array
     */
    public function map($document): array
    {
        return [
            $document->id,
            $document->title,
            $document->description,
            $document->category->name,
            $document->status == 1 ? 'Active' : 'InActive',
            $document->getMediaUrl(),
            $document->created_at,
        ];
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return ['ID', 'Name', 'Description', 'Category', 'Status', 'PDF Link', 'Created At'];
    }
}
