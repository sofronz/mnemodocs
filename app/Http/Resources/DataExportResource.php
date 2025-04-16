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
            'id'       => $status['id'],
            'name'     => $this['name'],
            'type'     => $this['type'],
            'status'   => $status['status'],
            'download' => route('dashboard.download', ['id' => $status['id']]),
        ];
    }

    /**
     * @return array
     */
    private function status()
    {
        $before = app(DataExportService::class)->before($this['type'], Auth::id());
        $after  = app(DataExportService::class)->after($this['type'], Auth::id());

        $status = 'ERROR';
        $id     = null;

        if (is_null($before) && is_null($after)) {
            $status = 'NONE';
        } elseif (! is_null($before) && is_null($after)) {
            $status = 'PROGRESS';
        } elseif (is_null($before) && ! is_null($after)) {
            $status = 'DONE';
            $id     = $after->id;
        }

        return [
            'status' => $status,
            'id'     => $id ?? 'null',
        ];
    }
}
