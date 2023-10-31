<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class SubCategory extends Model
{

    protected $primaryKey = 'sub_category_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id', 'name', 'status'
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

     /**
      * Get the phone record associated with the user.
      */
     public function category()
     {
         return $this->hasOne('App\Category', 'category_id', 'category_id');
     }

     public function getSubCategory($id){
        $subCategorys = SubCategory::where('category_id', $id)->where('status','1')->get()->toArray();
        return $subCategorys;
    }

    public function products(){
        return $this->hasMany('App\Product','sub_category_id','sub_category_id')->where('status','1');
     }
}
