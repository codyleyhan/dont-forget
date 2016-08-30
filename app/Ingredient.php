<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    public function recipe()
    {
    	$this->belongsTo(Recipe::class);
    }
}
