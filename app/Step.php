<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    public function recipe()
    {
    	$this->belongsTo(Recipe::class);
    }
}
