<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;

class Feedback extends Model
{
    use HasFactory;

    // protected $attributes = [
    //     'user_id' => 1,
    //     'event_id' => 1
    //   ];
    protected $fillable = ['event_id','user_id', 'Rating'];

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function event(): belongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
