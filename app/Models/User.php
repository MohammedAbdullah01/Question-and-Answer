<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
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
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    // Relation HasOne
    public function profile()
    {
        return $this->hasOne(Profile::class)->withDefault([
            'user_id' => Auth::id(),
            'mobile' => 'Empty',
            'gander' => 'Empty',
            'birthday' => 'Empty'
        ]);
    }
    // Relation HasMany questions
    public function questions()
    {
        return $this->hasMany(Questions::class);
    }
     // Relation HasMany Answer
     public function answers()
     {
         return $this->hasMany(Answer::class);
     }
}
