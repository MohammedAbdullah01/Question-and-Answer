<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = ['title' , 'user_id'];



    // Relation HasOne Only User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // Relation HasMany Answer
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
    // Relation Many To Many (Questions && Tags)
    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,     //Related Model
            'question_tag', //Pivot Table
            'question_id',  //Forignid For Current Model In Pivot Table
            'tag_id',       //Forignid For Related Model In Pivot Table
            'id',           //Local Key For Current Model
            'id'            //Local Key For Related Model
        );
    }

}
