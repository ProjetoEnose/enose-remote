<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
