<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function user()
    {
    	$this->belongsTo(User::class);
    }

		public function recipes()
		{
			$this->hasMany(Recipe::class);
		}
}
