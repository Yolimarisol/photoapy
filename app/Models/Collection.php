<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Collection extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'collections';

    protected $fillable = [
        'title',
        'users_id',
        'description',
        'update_at'
    ];

    public function images():BelongsToMany
    {
        return $this->belongsToMany(Image::class,'collections_images','images_id','collections_id')
        ->withTimestamps();
    }
}
