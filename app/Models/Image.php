<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Image extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'images';

    protected $fillable = [
        'title',
        'users_id',
        'description',
        'path',
        'image',
        'disk',
        'updated_at'
    ];

    public function collections():BelongsToMany
    {
        return $this->belongsToMany(Collection::class,'collections_images','collections_id','images_id')
        ->withTimestamps();
    }

}
