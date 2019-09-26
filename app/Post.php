<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{	

	use SoftDeletes;

	protected $fillable = [
		'title','content','featured','catagory_id','slug'
	];


	protected $dates = ['deleted_at'];



    //
    public function Catagory()
    {
    	return $this->belongsTo('App\Catagory');
    }

    

    public function getFeaturedAttribute($featured){
    	return asset($featured);
    }

    public function tags() {
        return $this->belongsToMany('App\Tag');
    }
}
