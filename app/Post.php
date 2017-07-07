<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    
	public function taxonomy(){
		return $this->belongsTo('App\Taxonomy');
	}

}
