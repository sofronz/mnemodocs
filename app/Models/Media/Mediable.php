<?php
namespace App\Models\Media;

use App\Models\Base;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * 
 *
 * @property string $id
 * @property string $mediable_type
 * @property string $mediable_id
 * @property string $media_id
 * @property string|null $metadata
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\Media\Media $media
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $mediable
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Mediable newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Mediable newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Mediable query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Mediable whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Mediable whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Mediable whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Mediable whereMediaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Mediable whereMediableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Mediable whereMediableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Mediable whereMetadata($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Mediable whereUpdatedAt($value)
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
