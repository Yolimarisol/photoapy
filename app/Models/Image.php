<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'disk',
        'updated_at'
    ];

}
