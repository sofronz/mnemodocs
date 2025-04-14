<?php
namespace App\Services\Traits;

use App\Models\Media\Media;
use App\Models\Media\Mediable;

trait HasMedia
{
    /**
     * Define relation morphMany to pivot table mediables
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function medias()
    {
        return $this->morphMany(Mediable::class, 'mediable');
    }

    /**
     * Attach media from this model
     *
     * @param Media $media
     *
     * @return Model
     */
    public function attachMedia(Media $media)
    {
        return $this->medias()->create([
            'media_id' => $media->id,
        ]);
    }

    /**
     * Detach media from this model
     *
     * @param Media $media
     *
     * @return Model
     */
    public function detachMedia(Media $media)
    {
        return $this->medias()->where('id', $media->id)->delete();
    }
}
