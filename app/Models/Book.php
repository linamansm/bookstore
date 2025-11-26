<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'aname',
        'bname',
        'price',
        'available',
        'description',
        'image',
        'favorite'

        ];
}
