<?php

namespace App\Http\Controllers;

use Auth;
use Gate;
use Illuminate\Http\Request;
use App\Http\Requests;

use App\Recipe;
use App\Category;
use App\Ingredient;
use App\Step;

class RecipesController extends Controller
{
		/**
		 * Custom messages for validation on recipes
		 */
		private $messages = [
			'name.required' => 'We need to name that recipe!',
			'num_of_people.required' => 'How many people does that feed again?',
			'num_of_people.min' => 'It should feed at least 1 person.',
			'num_of_people.numeric' => 'It should feed a number of people.',
			'prep_time.required' => 'How long does it take to prep again?',
			'prep_time.number' => 'How many whole minutes again to prep this recipe?',
			'prep_time.min' => 'It shoud be no time or greater to prep this meal.',
			'cook_time.required' => 'How long does it take to cook again?',
			'cook_time.number' => 'How many whole minutes again to cook this recipe?',
			'cook_time.min' => 'It shoud be no time or greater to cook this meal.'
		];


		public function __construct()
		{
				$this->middleware('auth');
		}


    public function index()
    {
    	$user = Auth::user()->id;

			$recipes = Recipe::all();

			return view('recipes.index', [
				'recipes' => $recipes
			]);
    }

		/**
		 * GET
		 * Page that displays form to create a recipe
		 * @return view rendered html back to user
		 */
		public function create()
		{
			$categories = Category::all();
			//return $categories;
			return view('recipes.create',[
				'categories' => $categories
			]);
		}

		/**
		 * Handles post request from the create recipe page with validation
		 * and inserts recipe into DB
		 * @param  Request $request request from the user
		 * @return redirect  redirects user back to index page
		 */
		public function store(Request $request)
		{

			$this->validate($request, [
				'name' => ['required', 'min:3'],
				'category' => ['required', 'min:3'],
				'description' => ['required', 'min:3'],
				'num_of_people' => ['required', 'min:0', 'numeric'],
				'prep_time' => ['required', 'min:0', 'numeric'],
				'cook_time' => ['required', 'min:0', 'numeric'],
				'ingredients' => ['required', 'min:1'],
				'ingredients.*.amount' =>['required', 'min:3'],
				'ingredients.*.name' =>['required', 'min:3'],
				'steps' => ['required', 'min:1'],
				'steps.*.description' => ['required', 'min:3']
			], $this->messages);


			// standardizes category
			$request->category = strtolower($request->category);

			$category = Category::firstOrNew([
				'name' => $request->category
			]);

			$category->save();

			$user = Auth::user()->id;

			$recipe = new Recipe([
				'user_id' => $user,
				'name' => $request->name,
				'description' => $request->description,
				'meal_time' => $request->meal_time,
				'num_of_people' => $request->num_of_people,
				'prep_time' => $request->prep_time,
				'cook_time' => $request->cook_time
			]);

			$category->recipes()->save($recipe);


			$ingredients = [];

			foreach($request->ingredients as $ingredient) {
				array_push($ingredients, new Ingredient([
					'name' => $ingredient['name'],
					'amount' => $ingredient['amount']
				]));
			}

			$recipe->ingredients()->saveMany($ingredients);

			$steps = [];

			foreach($request->steps as $step) {
				array_push($steps, new Step([
					'description' => $step['description']
				]));
			}

			$recipe->steps()->saveMany($steps);

			return redirect()->action('RecipesController@index')->with('status', 'Recipe Added');
		}


		public function show(Recipe $recipe)
		{
			$recipe->load('category');
			return view('recipes.show', [
				'recipe' => $recipe
			]);
		}

		public function edit(Recipe $recipe)
		{
			if(!Gate::allows('owns-recipe', $recipe)) {
				abort(403, 'This is not your recipe.');
			}

			$recipe->load('category', 'ingredients', 'steps');

			$categories = Category::all();

			return view('recipes.edit', [
				'recipe' => $recipe,
				'categories' => $categories
			]);
		}

		public function update(Request $request)
		{


			$this->validate($request, [
				'name' => ['required', 'min:3'],
				'category' => ['required', 'min:3'],
				'description' => ['required', 'min:3'],
				'num_of_people' => ['required', 'min:0', 'numeric'],
				'prep_time' => ['required', 'min:0', 'numeric'],
				'cook_time' => ['required', 'min:0', 'numeric'],
				'ingredients' => ['required', 'min:1'],
				'ingredients.*.amount' =>['required', 'min:3'],
				'ingredients.*.name' =>['required', 'min:3'],
				'steps' => ['required', 'min:1'],
				'steps.*.description' => ['required', 'min:3']
			], $this->messages);


		}
}
