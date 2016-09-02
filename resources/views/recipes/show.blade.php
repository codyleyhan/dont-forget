@extends('layouts.app') @section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
						<h1>{{ $recipe->name }}</h1>
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
						@if (session('status'))
						<div class="alert alert-success">
							{{ session('status') }}
						</div>
						@endif
						<div class="description">
							{{ $recipe->description }}
						</div>
						

					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
