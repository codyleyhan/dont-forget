@extends('layouts.app') @section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h1>Edit Recipe</h1></div>

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
						<form method="POST" action="/recipes/{{ $recipe->id }}">
							{{ csrf_field() }}

							<input type="hidden" name="_method" value="PUT">

							<div class="form-group">
								<label for="name">Recipe Name</label>
								<input type="text" class="form-control" name="name" placeholder="What are we making today?" value="{{ old('name') ?? $recipe->name }}" required>
							</div>

							<div class="form-group">
								<label for="name">Category</label>
								<input type="text" class="form-control" name="category" list="categories" value="{{ old('category') ?? ucwords($recipe->category->name) }}" placeholder="What kind of food is this?" required>
								<datalist id="categories">
										@foreach ($categories as $category)
											<option value="{{ ucwords($category->name) }}">
										@endforeach
								</datalist>
							</div>

							<div class="form-group">
								<label for="name">Meal Time</label>
								<select class="form-control" name="meal_time" list="meals" value="{{ old('meal_time') ?? $recipe->meal_time }}" required>
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
								<textarea class="form-control" name="description" placeholder="Give us a little information"  required>{{ old('description') ?? $recipe->description }}</textarea>
							</div>

							<div class="form-group">
								<label for="num_of_people">Feeds</label>
								<input type="number" class="form-control" name="num_of_people" placeholder="How many does it feed?" min=0 value="{{ old('num_of_people') ?? $recipe->num_of_people }}" required>
							</div>

							<div class="form-group">
								<label for="prep_time">Prep time</label>
								<div class="input-group">
									<input type="number" class="form-control" name="prep_time" placeholder="How long does it take to prep?" min=0 value="{{ old('prep_time') ?? $recipe->prep_time }}" required>
									<div class="input-group-addon">
										minutes
									</div>
								</div>
							</div>

							<div class="form-group">
								<label for="cook_time">Cook time</label>
								<div class="input-group">
									<input type="number" class="form-control" name="cook_time" placeholder="How long does it take to cook?" min=0 value="{{ old('cook_time') ?? $recipe->cook_time }}" required>
									<div class="input-group-addon">
										minutes
									</div>
								</div>
							</div>
							<button class="btn btn-primary">Update Recipe</button>

						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


@endsection
