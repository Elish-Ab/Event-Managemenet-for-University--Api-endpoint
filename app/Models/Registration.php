<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Event;
class Registration extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'event_id'
    ];

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
