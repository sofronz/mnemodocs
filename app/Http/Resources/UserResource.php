<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'email'      => $this->email,
            'is_deleted' => $this->isDeleted(),
            'role'       => [
                'id'   => $this->role->id,
                'name' => $this->role->name,
            ],
            'created_at' => $this->created_at->format('l, d F Y'),
        ];
    }
}
