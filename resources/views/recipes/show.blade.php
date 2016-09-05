@extends('layouts.app') @section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
						<h1>{{ $recipe->name }} <small>Serves {{ $recipe->num_of_people }}</small></h1>
				</div>

				<div class="panel-body">
					<div class="row text-center">
						<div class="col-md-4">
							Prepped in {{ $recipe->prep_time }} minutes
						</div>
						<div class="col-md-4">
							Cooked in {{ $recipe->cook_time }} minutes
						</div>
						<div class="col-md-4">
							Done in {{ $recipe->prep_time +  $recipe->cook_time }} minutes
						</div>
					</div>

					<hr>

					<div class="col-md-12">
						<h3>Information</h3>
						<dl class="dl-horizontal">
							<dt>Description</dt>
							<dd class="text-capitalize">{{ $recipe->description}}</dd>
							<dt>Category</dt>
							<dd class="text-capitalize">{{ $recipe->category->name }}</dd>
							<dt>Meal Time</dt>
							<dd class="text-capitalize">{{ $recipe->meal_time }}</dd>
						</dl>
					</div>



					<div class="col-md-12">
						@if (session('status'))
						<div class="alert alert-success">
							{{ session('status') }}
						</div>
						@endif
						<hr>

						<div class="col-md-12">
							<h3>Ingredients</h3>
							<ul class="list-group">
								@foreach ($recipe->ingredients as $ingredient)
									<li class="list-group-item">
										<span class="badge">{{ $ingredient['amount'] }}</span>
										{{ $ingredient->name }}
									</li>
								@endforeach
							</ul>
						</div>

						<div class="col-md-12">
							<h3>Steps</h3>
							<ul class="list-group">
								@for ($i = 0; $i < count($recipe->steps); $i++)
									<li class="list-group-item">
										 {{ $recipe->steps[$i]->description }}
										 <span class="badge">Step {{ $i+1 }}</span>
									</li>
								@endfor
							</ul>
						</div>


					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
