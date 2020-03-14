<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class books extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'write',
        'page_number',
    ];
}
