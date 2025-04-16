<?php
namespace App\Jobs;

use App\Exports\UsersExport;
use App\Services\DataExportService;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class ExportDataJob implements ShouldQueue
{
    use Queueable;

    /**
     * @var string
     */
    protected string $type;

    /**
     * @var int
     */
    protected int $user_id;

    /**
     * Create a new job instance.
     */
    public function __construct(string $type, int $user_id)
    {
        $this->type    = $type;
        $this->user_id = $user_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $fileName = $this->type . '_exported_' . time() . '.xlsx';
        $filePath = Storage::disk('public')->path($fileName);

        if ($this->type == 'user') {
            Excel::store(new UsersExport, $filePath, 'public');

            app(DataExportService::class)->before($this->type, $this->user_id)->update([
                'file_path' => $filePath,
            ]);
        }
    }
}
