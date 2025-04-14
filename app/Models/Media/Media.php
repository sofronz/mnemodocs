<?php
namespace App\Models\Media;

use App\Models\Base;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 *
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Media newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Media newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Media onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Media query()
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
    protected $table = 'inv_media';

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
