@extends('layouts.app')

@section('content')
	<div class="container">
		@if(Session::has('flash_message'))
			<div class="alert alert-success center">{!! session('flash_message') !!}</div>
		@endif

		@if(Session::has('flash_message_error'))
			<div class="alert alert-danger center">{!! session('flash_message_error') !!}</div>
		@endif

		@if (count($errors) > 0)
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif

		<h3>Edit <i>{{ $item->name }}</i></h3>

		<form method="post">
			{!! csrf_field() !!}

			<div class="input-group">
				<label>Name</label>
				<input type="text" class="form-control" name="name" placeholder="Asset name" value="{{ $item->name }}" required>
			</div>
			<br>
			<div class="input-group">
				<label>Description</label>
				<textarea class="form-control" name="description" placeholder="Asset description">{{ $item->description }}</textarea>
			</div>
			<br>
			<div class="input-group">
				<label>Price</label>
				<input type="number" step="1" class="form-control" name="price" placeholder="Asset price" value="{{ $item->price }}" required>
			</div>
			<br>
			<div class="input-group">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div>
@endsection
