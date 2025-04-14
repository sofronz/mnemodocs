<?php
namespace App\Models;

use Kalnoy\Nestedset\NodeTrait;
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
    use HasFactory, SoftDeletes, NodeTrait;
    
    /**
     * @var string
     */
    protected $table = 'md_taxonomies';

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
}
