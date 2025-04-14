<?php
namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 *
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Taxonomy newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Taxonomy newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Taxonomy onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Taxonomy query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Taxonomy withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Taxonomy withoutTrashed()
 * @mixin \Eloquent
 */
class Taxonomy extends Base
{
    use HasFactory, SoftDeletes;
    
    /**
     * @var string
     */
    protected $table = 'inv_taxonomies';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'status',
        'metadata',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'metadata' => 'object',
    ];

    /**
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->slug = Str::slug($model->name);
        });

        static::updating(function ($model) {
            $model->slug = Str::slug($model->name);
        });
    }
}
