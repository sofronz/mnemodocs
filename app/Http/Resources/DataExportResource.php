<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Services\DataExportService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Resources\Json\JsonResource;

class DataExportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $status = $this->status();

        return [
            'name'   => $this->name,
            'type'   => $this->type,
            'status' => $status['status'],
            'file'   => $status['file'],
        ];
    }

    /**
     * @return array
     */
    private function status()
    {
        $before = app(DataExportService::class)->before($this->type, Auth::user()->id);
        $after  = app(DataExportService::class)->after($this->type, Auth::user()->id);

        if (is_null($before) && is_null($after)) {
            return [
                'status' => 'NONE',
                'file'   => null,
            ];
        } elseif (! is_null($before) && is_null($after)) {
            return [
                'status' => 'PROGRESS',
                'file'   => null,
            ];
        } elseif (is_null($before) && ! is_null($after)) {
            return [
                'status' => 'DONE',
                'file'   => $after->file_path,
            ];
        }

        return [
            'status' => 'ERROR',
            'file'   => null,
        ];
    }
}
