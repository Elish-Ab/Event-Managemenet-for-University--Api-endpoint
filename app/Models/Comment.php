<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Comment extends Model
{
    use HasFactory;

    protected $fillable=[
        "id",
        "body"
    ];

    public function commentable(): MorphTo
    {

        return $this->morphTo();
    }
}
