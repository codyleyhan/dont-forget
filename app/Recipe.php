<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{

		public function category()
		{
			$this->belongsTo(Category::class);
		}

		public function ingredients()
    {
    	$this->hasMany(Ingredient::class);
    }

		public function steps()
		{
			$this->hasMany(Step::class);
		}

		public function user()
		{
			$this->belongsTo(User::class);
		}
}
