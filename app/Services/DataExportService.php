<?php
namespace App\Services;

use App\Models\DataExport;
use App\Services\Traits\BaseTrait;

class DataExportService
{
    use BaseTrait;

    /**
     * DataExportService Constructor
     */
    public function __construct()
    {
        $this->model = new DataExport();
    }

    /**
     * @param string $type
     * @param int $user_id
     *
     * @return bool
     */
    public function detach(string $type, int $user_id)
    {
        return $this->builder()->where('type', $type)->where('exported_by', $user_id)->delete();
    }

    /**
     * @param string $type
     * @param int $user_id
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function before(string $type, int $user_id)
    {
        return $this->builder()->where('type', $type)->whereNull('file_path')->where('exported_by', $user_id)->first();
    }

    /**
     * @param string $type
     * @param int $user_id
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function after(string $type, int $user_id)
    {
        return $this->builder()->where('type', $type)->whereNotNull('file_path')->where('exported_by', $user_id)->first();
    }
}
