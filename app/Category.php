<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Category extends Model
{

    protected $primaryKey = 'category_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'status'
    ];

    /**
     * Accessor for name
     *
     * @return array
     */
     public function getNameAttribute($value)
     {
         return ucfirst($value);
     }
}
