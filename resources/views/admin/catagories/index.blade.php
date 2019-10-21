@extends('layouts.app')

@section('content')

	<div class="panel panel-default">
		<div class="panel-body">
				<table class="table table-hover">
		<thead>
			<th>
				Catagory Name
			</th>

			<th>
				Editing the category			</th>

			<th>
				Deleting the category			</th>
		</thead>


		<tbody>
			@if($catagories->count() > 0)
				@foreach($catagories as $catagory)
				<tr>
					<td>
					{{ $catagory->name }}
					</td>

					<td>
						<a href="{{ route('catagory.edit',['id' => $catagory->id]) }}" class="btn btn-xs btn-info">Edit</a>
					</td>

					<td>
						<a href="{{ route('catagory.delete',['id' => $catagory->id]) }}" class="btn btn-xs btn-danger">Delete</a>
					</td>
				</tr>
				@endforeach
			@else

				<tr>
					<th colspan="5" class="text-center">No catagories found!</th>
				</tr>

			

				@endif

		</tbody>
	</table>	
		</div> 
	</div>
	
@stop