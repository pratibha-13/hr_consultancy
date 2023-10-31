<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class FAQ extends Model
{

    protected $table = 'faq';
    protected $primaryKey = 'faq_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question','answer','type' //,status
    ];
}
