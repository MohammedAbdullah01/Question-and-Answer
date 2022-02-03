<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $fillable = ['name'];



    // Relation Many To Many (Tags && Questions)
    public function questions()
    {
        return $this->belongsToMany(
            Question::class,  //Related Model
            'questio_tag',    //Pivot Table
            'tag_id',         //Forignid For Current Model In Pivot Table
            'question_id',    //Forignid For Related Model In Pivot Table
            'id',             //Local Key For Current Model
            'id'              //Local Key For Related Model
        );
    }
}
