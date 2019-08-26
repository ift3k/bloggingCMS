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
				Editing the catagory
			</th>

			<th>
				Deleting the catagory
			</th>
		</thead>


		<tbody>
			@foreach($catagories as $catagory)
				<tr>
					<td>
					{{ $catagory->name }}
					</td>

					<td>
						<a href="{{ route('catagory.create',['id' => $catagory->id]) }}" class="btn btn-xs btn-info">Edit</a>
					</td>

					<td>
						<a href="{{ route('catagory.delete',['id' => $catagory->id]) }}" class="btn btn-xs btn-danger">Delete</a>
					</td>
				</tr>
				@endforeach
		</tbody>
	</table>	
		</div>
	</div>
	
@stop