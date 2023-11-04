<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blog';
    protected $primaryKey = 'blog_id';

    public function getBlogImageAttribute($value){
        if($value != '' && $value != null){
            if(isset($value)) {
                return (url('/resources/uploads/blog_image').'/').$value;
            }else{
                return url('/resources/assets/img/default.png');
            }
        }else {
            return url('/resources/assets/img/default.png');
        }
    }
}
