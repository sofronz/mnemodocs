<?php
namespace App\Services;

use App\Models\Media\Media;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use App\Services\Traits\BaseTrait;
use Illuminate\Support\Facades\Storage;

class MediaService
{
    use BaseTrait;

    /**
     * MediaService Constructor
     */
    public function __construct()
    {
        $this->model = new Media();
    }
    
    /**
     * @param UploadedFile $file
     *
     * @return Media
     */
    public function upload(UploadedFile $file): Media
    {
        $this->validateFile($file);

        $filename = $this->fileName($file);
        $path     = $this->storeFile($file, $filename);

        return $this->saveMediaRecord($file, $path);
    }

    /**
     * @param UploadedFile $file
     *
     * @return void
     */
    protected function validateFile(UploadedFile $file): void
    {
        if (! $file->isValid()) {
            throw new \Exception('File tidak valid.');
        }

        if ($file->getClientOriginalExtension() !== 'pdf') {
            throw new \Exception('Hanya file PDF yang diperbolehkan.');
        }

        if ($file->getSize() < 102400 || $file->getSize() > 512000) {
            throw new \Exception('Ukuran file harus antara 100KB - 500KB.');
        }
    }

    /**
     * @param UploadedFile $file
     *
     * @return string
     */
    protected function fileName(UploadedFile $file): string
    {
        return Str::uuid() . '.' . $file->getClientOriginalExtension();
    }

    /**
     * @param UploadedFile $file
     * @param string $filename
     *
     * @return string
     */
    protected function storeFile(UploadedFile $file, string $filename): string
    {
        return $file->storeAs('uploads/media', $filename, 'public');
    }

    /**
     * @param UploadedFile $file
     * @param string $path
     *
     * @return Media
     */
    protected function saveMediaRecord(UploadedFile $file, string $path): Media
    {
        return $this->store([
            'file_name' => $file->getClientOriginalName(),
            'file_path' => $path,
            'mime_type' => $file->getMimeType(),
            'file_size' => $file->getSize(),
        ]);
    }

    /**
     * @param Media $media
     *
     * @return bool
     */
    public function delete(Media $media): bool
    {
        if (Storage::disk('public')->exists($media->file_path)) {
            Storage::disk('public')->delete($media->file_path);
        }

        return $media->delete();
    }
}
