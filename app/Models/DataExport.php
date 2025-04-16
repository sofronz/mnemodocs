<?php
namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * 
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DataExport newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DataExport newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DataExport onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DataExport query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DataExport withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DataExport withoutTrashed()
 * @mixin \Eloquent
 */
class DataExport extends Base
{
    use HasFactory, SoftDeletes;
    
    /**
     * @var string
     */
    protected $table = 'md_data_export';

    /**
     * @var array
     */
    protected $fillable = [
        'type',
        'file_path',
        'metadata',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'metadata' => 'object',
    ];
}
