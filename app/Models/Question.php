<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'category_id',
        'text_ar',
        'text_en',
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
