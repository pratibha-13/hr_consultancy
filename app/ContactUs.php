<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helper\GlobalHelper;
use Illuminate\Notifications\Notifiable;
use DB;


class ContactUs extends Model
{
    use Notifiable;
    protected $table = 'contact_us';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'id', 'name', 'email', 'description', 'created_at', 'updated_at', 'deleted_at'
    // ];
    



}
