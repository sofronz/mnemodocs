<?php
namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 *
 *
 * @property string $id
 * @property string $type
 * @property string|null $file_path
 * @property string $exported_by
 * @property object|null $metadata
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DataExport newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DataExport newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DataExport onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DataExport query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DataExport whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DataExport whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DataExport whereExportedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DataExport whereFilePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DataExport whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DataExport whereMetadata($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DataExport whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|DataExport whereUpdatedAt($value)
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
        'exported_by',
        'metadata',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'metadata' => 'object',
    ];
}
