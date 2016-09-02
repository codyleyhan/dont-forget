<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
		protected $fillable = ['user_id', 'category_id', 'name', 'description',
			'in_list', 'meal_time', 'num_of_people', 'prep_time', 'cook_time'];

		public function category()
		{
			return $this->belongsTo(Category::class);
		}

		public function ingredients()
    {
    	return $this->hasMany(Ingredient::class);
    }

		public function steps()
		{
			return $this->hasMany(Step::class);
		}

		public function user()
		{
			return $this->belongsTo(User::class);
		}
}
