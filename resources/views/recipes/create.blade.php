@extends('layouts.app') @section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h1>Add Recipe</h1></div>

				<div class="panel-body">
					<div class="col-md-10 col-md-offset-1">
						@if (count($errors) > 0)
						<div class="alert alert-warning">
							<ul>
								@foreach ($errors->all() as $message)
								<li>{{ $message }}</li>
								@endforeach
							</ul>
						</div>
						@endif
						<form method="POST" action="/recipes">
							{{ csrf_field() }}
							<div class="form-group">
								<label for="name">Recipe Name</label>
								<input type="text" class="form-control" name="name" placeholder="What are we making today?" value="{{ old('name') }}" required>
							</div>

							<div class="form-group">
								<label for="name">Category</label>
								<input type="text" class="form-control" name="category" list="categories" value="{{ old('category') }}" placeholder="What kind of food is this?" required>
								<datalist id="categories">
										@foreach ($categories as $category)
											<option value="{{ ucwords($category->name) }}">
										@endforeach
								</datalist>
							</div>

							<div class="form-group">
								<label for="name">Meal Time</label>
								<select class="form-control" name="meal_time" list="meals" value="{{ old('meal_time') }}" required>
									<option value="Breakfast">Breakfast</option>
									<option value="Brunch">Brunch</option>
									<option value="Lunch">Lunch</option>
									<option value="Snack" selected>Snack</option>
									<option value="Dinner">Dinner</option>
									<option value="Dessert">Dessert</option>
								</select>
							</div>

							<div class="form-group">
								<label for="description">Description</label>
								<textarea class="form-control" name="description" placeholder="Give us a little information"  required>{{ old('description') }}</textarea>
							</div>

							<div class="form-group">
								<label for="num_of_people">Feeds</label>
								<input type="number" class="form-control" name="num_of_people" placeholder="How many does it feed?" min=0 value="{{ old('num_of_people') }}" required>
							</div>

							<div class="form-group">
								<label for="prep_time">Prep time</label>
								<div class="input-group">
									<input type="number" class="form-control" name="prep_time" placeholder="How long does it take to prep?" min=0 value="{{ old('prep_time') }}" required>
									<div class="input-group-addon">
										minutes
									</div>
								</div>
							</div>

							<div class="form-group">
								<label for="cook_time">Cook time</label>
								<div class="input-group">
									<input type="number" class="form-control" name="cook_time" placeholder="How long does it take to cook?" min=0 value="{{ old('cook_time') }}" required>
									<div class="input-group-addon">
										minutes
									</div>
								</div>
							</div>

							<div class="form-group">
								<label for="ingredients">Ingredients</label>
								<div id="ingredient-list">
									<div class="col-xs-12">
										<div class="form-inline">
											<input type="text" class="form-control" v-model="newAmount" placeholder="How much?">
											<div class="form-group">
												<input type="text" class="form-control" v-model="newIngredient" v-on:keydown.enter.prevent="addIngredient" placeholder="Of what?" >
												<button type="button" class="btn btn-info" v-on:click="addIngredient">+</button>
											</div>
										</div>
									</div>

									<br>
									<div class="col-xs-12">
										<ul class="list-group ingredients-list">
											<li class="list-group-item" v-for="ingredient in ingredients">
													<div class="form-inline">
														<span class="align-right list-delete">
																<button type="button" class="btn btn-danger" @click="removeIngredient">&#10008;</button>
														</span>
														<input type="text" name="ingredients[@{{$index}}][amount]" class="form-control" value="@{{ ingredient.amount }}" v-on:keydown.enter.prevent placeholder="How much?">
														<input type="text" name="ingredients[@{{$index}}][name]" class="form-control" value="@{{ ingredient.name | capitalize }}" v-on:keydown.enter.prevent placeholder="Of what?" >
													</div>
											</li>
										</ul>
									</div>
								</div>
							</div>

							<div class="form-group">
								<label for="steps">Steps</label>
								<div id="step-list">
									<div class="col-xs-12">
										<div class="input-group">
											<input type="text" class="form-control" v-model="newStep" v-on:keydown.enter.prevent="addStep">
											<span class="input-group-btn">
													<button type="button" class="btn btn-info" v-on:click="addStep">+</button>
											</span>
										</div>
									</div>

									<br>
									<div class="col-xs-12">
										<ul class="list-group ingredients-list">
											<li class="list-group-item" v-for="step in steps">
												<div class="input-group">
													<span class="input-group-addon">
														Step @{{ $index+1 }}
													</span>
													<input class="form-control" type="text" v-on:keydown.enter.prevent name="steps[@{{$index}}][description]" value="@{{ step.description | capitalize }}">
													<span class="input-group-btn">
															<button type="button" class="btn btn-danger" @click="removeStep">&#10008;</button>
													</span>
												</div>
											</li>
										</ul>
									</div>
								</div>
							</div>

							<button class="btn btn-primary">Add Recipe</button>

						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>

let oldIngredients = [];
let oldSteps = [];

<?php
$ingredients = json_encode(old('ingredients'));
$steps = json_encode(old('steps'));

echo "oldIngredients = ". $ingredients . ";\n";
echo "oldSteps = ". $steps . ";\n";
?>



</script>

@endsection
