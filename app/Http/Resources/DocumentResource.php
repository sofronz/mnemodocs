<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DocumentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'description' => $this->description,
            'status'      => (bool) $this->status,
            'category'    => [
                'id'   => $this->category->id,
                'name' => $this->category->name,
            ],
            'uploaded' => [
                'id'   => $this->uploaded_by,
                'name' => $this->uploaded->name,
            ],
            'file' => [
                'name' => $this->getMedia()?->file_name,
                'url'  => $this->getMediaUrl(),
            ],
            'created_at' => $this->created_at->format('l, d F Y'),
        ];
    }
}
