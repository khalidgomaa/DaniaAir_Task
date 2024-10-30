<?php

namespace App\Models;

use App\Models\Question;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'checklist_id',  
        'question_id',   
        'response',      
        'comments',       
    ];
    public function Question()
    {
        return $this->belongsTo(Question::class);
    }
}
