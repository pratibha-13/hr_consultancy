<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chat extends Model
{
    use SoftDeletes;
    protected $table = 'chats';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id', 'user_id1', 'user_id2', 'message', 'user_id1_read', 'user_id2_read', 'user_id1_unread_count', 'user_id2_unread_count', 'created_at', 'updated_at', 'deleted_at'
    ];
    
    protected $dates = ['created_at', 'updated_at'];

    public function userOneData(){
        return $this->hasOne('App\User','id','user_id2')->select('*')->with(['countyData','stateData','cityData']);
    }

    public function userTwoData(){
        return $this->hasOne('App\User','id','user_id1')->select('*')->with(['countyData','stateData','cityData']);
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value);
    }
}
