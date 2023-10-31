<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomePageSlider extends Model
{
    protected $table = 'home_page_slider';
    protected $primaryKey = 'home_page_slider_id';

    public function getImageAttribute($value){
        if($value != '' && $value != null){
            if(isset($value)) {
                return (url('/resources/uploads/sliderImage/').'/').$value;
            }else{
                return '';
            }
        }else {
            return '';
        }
    }
}
