<?php
namespace App\Models\Media;

use App\Models\Base;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 *
 *
 * @property string $id
 * @property string $file_name
 * @property string $file_path
 * @property string $mime_type
 * @property string $file_size
 * @property int $status
 * @property object|null $metadata
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Media newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Media newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Media onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Media query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Media whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Media whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Media whereFileName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Media whereFilePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Media whereFileSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Media whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Media whereMetadata($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Media whereMimeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Media whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Media whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Media withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Media withoutTrashed()
 * @mixin \Eloquent
 */
class Media extends Base
{
    use HasFactory, SoftDeletes;
    
    /**
     * @var string
     */
    protected $table = 'md_media';

    /**
     * @var array
     */
    protected $fillable = [
        'file_name',
        'file_path',
        'mime_type',
        'file_size',
        'status',
        'metadata',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'metadata' => 'object',
    ];
}
