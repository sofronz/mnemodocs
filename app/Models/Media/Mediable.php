<?php
namespace App\Models\Media;

use App\Models\Base;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 *
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read Media|null $media
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $mediable
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Mediable newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Mediable newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Mediable onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Mediable query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Mediable withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Mediable withoutTrashed()
 * @mixin \Eloquent
 */
class Mediable extends Base
{
    use HasFactory;
    
    /**
     * @var string
     */
    protected $table = 'md_mediables';

    /**
     * @var array
     */
    protected $fillable = [
        'mediable_type',
        'mediable_id',
        'media_id',
        'metadata',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function mediable()
    {
        return $this->morphTo();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function media()
    {
        return $this->belongsTo(Media::class, 'media_id', 'id');
    }
}
