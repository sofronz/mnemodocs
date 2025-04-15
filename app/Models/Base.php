<?php
namespace App\Models;

use Illuminate\Support\Str;
use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as ContractsAuditable;

/**
 *
 *
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Base newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Base newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Base query()
 * @mixin \Eloquent
 */
class Base extends Model implements ContractsAuditable
{
    use Auditable;

    /**
     * @var string
     */
    protected $keyType = 'string';

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        // Auto generate UUID sebelum menyimpan data
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    /**
     * @return bool
     */
    public function isDeleted()
    {
        return ! is_null($this->deleted_at) ? true : false;
    }
}
