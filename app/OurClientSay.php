<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OurClientSay extends Model
{
    protected $table = 'our_client_say';
    protected $primaryKey = 'our_client_say_id';

    public function getOurClientSayProfileAttribute($value){
        if($value != '' && $value != null){
            if(isset($value)) {
                return (url('/resources/uploads/profile').'/').$value;
            }else{
                return url('/resources/assets/img/default.png');
            }
        }else {
            return url('/resources/assets/img/default.png');
        }
    }
}
