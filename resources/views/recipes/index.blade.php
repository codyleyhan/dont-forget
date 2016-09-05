@extends('layouts.app') @section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h1>Recipes</h1>
				</div>

				<div class="panel-body">
					<div class="col-md-10 col-md-offset-1">
						@if (session('status'))
						<div class="alert alert-success">
							{{ session('status') }}
						</div>
						@endif

						<ul class="list-group">
							@foreach ($recipes as $recipe)
							<li class="list-group-item">
								<a href="/recipes/{{$recipe->id}}">{{ $recipe->name }}</a>
								<span> - </span>
								{{ substr($recipe->description,0,49)}}...
								<span class="badge">{{$recipe->category->name}}</span>
							</li>
							@endforeach
						</ul>
						<a href="/recipes/create"><button class="btn btn-info">Create a Recipe</button></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
