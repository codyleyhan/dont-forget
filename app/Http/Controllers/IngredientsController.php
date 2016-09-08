<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;


use App\Ingredient;
use App\Recipe;

class IngredientsController extends Controller
{

		private $messages = [
			'recipe_id.required' => 'A recipe is required.'
		];

    public function update(Request $request, Ingredient $ingredient)
    {
			$this->validate($request, [
				'name' => ['required', 'min:3'],
				'amount' => ['required', 'min:1']
			]);

    	$ingredient->load('recipe.user');

			if($ingredient->recipe->user_id != Auth::user()->id) {
				abort(403);
			}

			$ingredient->name = $request->name;
			$ingredient->amount = $request->amount;

			$ingredient->save();

			return $ingredient;
    }

		public function store(Request $request)
		{

			$this->validate($request, [
				'name' => ['required', 'min:3'],
				'amount' => ['required', 'min:1'],
				'recipe_id' => ['required']
			]);

			$recipe = Recipe::where('id', $request->recipe_id)->first();

			if($recipe->user_id != Auth::user()->id) {
				abort(403);
			}

			$ingredient = new Ingredient([
				'name' => $request->name,
				'amount' => $request->amount
			]);

			$recipe->ingredients()->save($ingredient);

			return $ingredient;
		}

		public function delete(Ingredient $ingredient)
		{
			$ingredient->load('recipe.user');

			if($ingredient->recipe->user->id == Auth::user()->id) {
				$ingredient->delete();
			} else {
				return abort(403, 'That is not your ingredient.');
			}

			return [
				'message' => 'Ingredient deleted.'
			];
		}
}
