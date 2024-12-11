<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use InvalidArgumentException;

class ProfileImage extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'id',
        'path',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function deleteFileImageOnDeleteRegister(string $path)
    {
        if (Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->delete($path);
        }

        throw new InvalidArgumentException("A imagem para o o caminho $path não existe.");
    }

    public static function saveImage(UploadedFile $fileImage)
    {
        $nameImage = 'image' . '-' . uniqid() . '.' . $fileImage->getClientOriginalExtension();
        return $fileImage->storeAs('uploads', $nameImage, env('FILESYSTEM_DISK', 'public'));
    }
}
