@extends('layouts.app')



@section('content')

	
	@include('admin.includes.errors')

	<div class="panel panel-default">
		<div class="panel-heading">
			Update category: {{ $catagory->name }}
		</div>

		<div class="panel-body">
			<form action="{{ route('catagory.update', ['id'=>$catagory->id] )}}" method="post">
				{{ csrf_field() }}

				<div class="form-group">
					<label for="name">Name</label>
					<input type="text" name="name" value=" {{ $catagory->name }} " class="form-control">
				</div>

				<div class="form-group">
					<div class="text-center">
						<button class="btn btn-success" type="submit">
							Update category						</button>
					</div>
				</div>

			</form>
		</div>
	</div>

@endsection