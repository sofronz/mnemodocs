<?php
namespace App\Models;

use App\Models\Taxonomy\Category;
use App\Services\Traits\HasMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 *
 *
 * @property string $id
 * @property string $title
 * @property string $category_id
 * @property string $uploaded_by
 * @property string|null $description
 * @property int $status
 * @property object|null $metadata
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Media\Mediable> $medias
 * @property-read int|null $medias_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Document newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Document newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Document onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Document query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Document whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Document whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Document whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Document whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Document whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Document whereMetadata($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Document whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Document whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Document whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Document whereUploadedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Document withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Document withoutTrashed()
 * @mixin \Eloquent
 */
class Document extends Base
{
    use HasFactory, SoftDeletes, HasMedia;
    
    /**
     * @var string
     */
    protected $table = 'md_documents';

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'uploaded_by',
        'status',
        'category_id',
        'metadata',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'metadata' => 'object',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function uploaded()
    {
        return $this->belongsTo(User::class, 'uploaded_by', 'id');
    }
}
