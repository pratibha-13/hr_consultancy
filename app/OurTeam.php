<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OurTeam extends Model
{
    protected $table = 'our_team';
    protected $primaryKey = 'our_team_id';

    public function getProfileAttribute($value){
        if($value != '' && $value != null){
            if(isset($value)) {
                return (url('/resources/uploads/profile').'/').$value;
            }else{
                return url('/resources/assets/img/user.png');
            }
        }else {
            return url('/resources/assets/img/user.png');
        }
    }
}
