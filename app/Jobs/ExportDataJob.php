<?php
namespace App\Jobs;

use App\Exports\RolesExport;
use App\Exports\UsersExport;
use App\Exports\DocumentsExport;
use App\Exports\CategoriesExport;
use App\Services\DataExportService;
use Maatwebsite\Excel\Facades\Excel;
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
     * @var string
     */
    protected string $user_id;

    /**
     * Create a new job instance.
     */
    public function __construct(string $type, string $user_id)
    {
        $this->type    = $type;
        $this->user_id = $user_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $fileName     = $this->type . '_exported_' . time() . '.xlsx';
        $relativePath = 'exports/' . $fileName;
        
        $exportClass = match ($this->type) {
            'user'     => new UsersExport,
            'role'     => new RolesExport,
            'category' => new CategoriesExport,
            'document' => new DocumentsExport,
            default    => null,
        };

        if ($exportClass) {
            Excel::store($exportClass, $relativePath, 'public');

            app(DataExportService::class)->before($this->type, $this->user_id)->update([
                'file_path' => $relativePath,
            ]);
        }
    }
}
