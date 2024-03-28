<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\hasMany;

class Event extends Model
{
    use HasFactory;
 

    protected $table = 'events';
    protected $casts = [
        'type' => 'string',
        'status' => 'string'
      ];
      protected $fillable = [
        'Title',
        'Description',
        'Date',
        'Location',
        'Time',
        'Capacity',
        'Type',
        'Status',
        'Registration_deadline',
        'Image'
    ];

      protected $dates = [
        'date',
        'registration_deadline' 
      ];
      protected $hidden = [
        'Description',
        'Image' 
      ];

    public function users(): belongsTo
    {
      return $this->belongsTo(User::class);
    } 
    
    public function feedbacks(){
      return $this->hasMany(Feedback::class);
    }


    public function registrations(): hasMany
    {
      return $this->hasMany(Registration::class);
    }

    public function notifications(): MorphMany
    {
        return $this->morphMany(Notification::class,'notifiable');
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
