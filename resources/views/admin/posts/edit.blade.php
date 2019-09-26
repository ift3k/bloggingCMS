@extends('layouts.app')



@section('content')

	
	@include('admin.includes.errors')

	<div class="panel panel-default">
		<div class="panel-heading">
			Edit post: {{ $post->title }}
		</div>

		<div class="panel-body">
			<form action="{{ route('post.update', ['id' => $post->id] )}}" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}

				<div class="form-group">
					<label for="title">Title</label>
					<input type="text" name="title" class="form-control" value="{{ $post->title }}">
				</div>


				<div class="form-group">
					<label for="featured">Featured Image</label>
					<input type="file" name="featured" class="form-control">
				</div>


				<div class="form-group">
					<label for="catagory">Select a category</label>
					<select name="catagory_id" id="catagory" class="form-control">
						@foreach($catagories as $catagory)

						<option value=" {{ $catagory->id }} "> {{ $catagory->name }} </option>
						@endforeach 
					</select>
				</div>

				<div class="form-group">
					<label for="content">Content</label>
					<textarea name="content" id="content" cols="5" rows="5" class="form-control">{{ $post->content }}</textarea>
				</div>

				<div class="form-group">
					<div class="text-center">
						<button class="btn btn-success" type="submit">
							Update Post
						</button>
					</div>
				</div>

			</form>
		</div>
	</div>

@endsection