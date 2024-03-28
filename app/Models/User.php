<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Event;
use App\Models\Comment;
use App\Models\Feedback;
use App\Models\Registration;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\hasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */

    public function events(): hasMany
    {
        	return $this->hasMany(Event::class);
    }

    // public function roles(){
    //         return $this->hasMany(Role::class);
    // }

    public function feedbacks(): hasMany
    {
        return $this->hasMany(Feedback::class);
    }
    public function registrations(): hasMany
    {
        return $this->hasMany(Registration::class);
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class,'commentable');
    }
    public function notifications(): MorphMany
    {
        return $this->morphMany(Comment::class,'notifiable');
    }

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
