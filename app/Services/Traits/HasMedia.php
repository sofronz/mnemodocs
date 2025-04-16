<?php
namespace App\Services\Traits;

use App\Models\Media\Media;
use App\Models\Media\Mediable;
use Illuminate\Support\Facades\Storage;

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
     * @return Media
     */
    public function getMedia()
    {
        return $this->medias()->first()?->media;
    }

    /**
     * @return string
     */
    public function getMediaUrl()
    {
        $media = $this->getMedia();

        return asset(Storage::url($media?->file_path));
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
     * @return Model
     */
    public function detachMedia()
    {
        if ($this->medias->isNotEmpty()) {
            return $this->medias()->delete();
        }

        return null;
    }
}
