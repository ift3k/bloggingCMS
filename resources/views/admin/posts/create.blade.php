@extends('layouts.app')



@section('content')

	
	@include('admin.includes.errors')

	<div class="panel panel-default">
		<div class="panel-heading">
			Create a new post
		</div>

		<div class="panel-body">
			<form action="{{ route('post.store' )}}" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}

				<div class="form-group">
					<label for="title">Title</label>
					<input type="text" name="title" class="form-control">
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

					<label for="tags">Select tags: </label>

					@foreach($tags as $tag)

					<div class="checkbox">

					<label><input type="checkbox" name="tags[]" value=" {{ $tag->id }} ">{{$tag->tag }}</label>

					</div>

					@endforeach

				</div>



				<div class="form-group">
					<label for="content">Content</label>
					<textarea name="content" id="mytextarea" cols="5" rows="5" class="form-control"></textarea>
				</div>

				<div class="form-group">
					<div class="text-center">
						<button class="btn btn-success" type="submit">
							Store Post
						</button>
					</div>
				</div>

			</form>
		</div>
	</div>

@endsection



@section('scripts')
	
  <script>
          tinymce.init({
    		selector: '#mytextarea'
  });           
   </script>
@stop