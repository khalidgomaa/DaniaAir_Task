<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    protected $fillable = [
        'inspector',  
        'date',       
        'time',       
    ];
    public function answers()
    {
        return $this->hasMany(Answer::class, 'checklist_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'inspector');
    }
}
