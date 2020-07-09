<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Beat extends Model
{
    protected $fillable = [
        'name', 'order'
    ];
}
