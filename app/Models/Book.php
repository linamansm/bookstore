<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;



class Book extends Model
{
    protected $fillable = [
        'aname',
        'bname',
        'price',
        'available',
        'description',
        'image',
        'favorite',
        'category_id', 


        ];

        public function category()
{
    return $this->belongsTo(Category::class);
}

        
}


