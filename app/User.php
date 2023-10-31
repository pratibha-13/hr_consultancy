<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use DB;
use Auth;
use Carbon\Carbon;

class User extends Authenticatable
{

   use HasApiTokens, Notifiable,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'name', 'email'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


   public function getProfileImageAttribute($value){
        if($value != '' && $value != null){
            if(isset($value)) {
                return (url('/resources/uploads/profile/').'/').$value;
            }else{
                return '';
            }
        }else {
            return '';
        }
    }

    public function countyData(){
        return $this->hasOne('App\Country','country_id','country')->select('country_id','name');
    }
    public function stateData(){
        return $this->hasOne('App\State','state_id','state')->select('state_id','name');
    }
    public function cityData(){
        return $this->hasOne('App\City','city_id','city')->select('city_id','name');
    }
    public static function getAllUsers(){
        $user = User::whereHas('roles', function($q){$q->where('name','user');})->where('user_status','=','1')->get();
        return $user;
    }
}
