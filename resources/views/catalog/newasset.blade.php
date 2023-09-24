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

		<h3>New Asset</h3>
		<p>It costs 5 Huefish to create an asset. Accepted formats are PNG and JPG.</p>

		<form method="post" enctype="multipart/form-data">
			{!! csrf_field() !!}

			<div class="input-group">
				<label>Name</label>
				<input type="text" class="form-control" name="name" placeholder="Asset name" value="{{ Request::old('name') }}" required>
			</div>
			<br>
			<div class="input-group">
				<label>Description</label>
				<textarea class="form-control" name="description" placeholder="Asset description">{{ Request::old('description') }}</textarea>
			</div>
			<br>
			<div class="input-group">
				<label>Price</label>
				<input type="number" step="1" class="form-control" name="price" placeholder="Asset price" value="{{ Request::old('price', "10") }}" required>
			</div>
			<br>
			<div class="input-group">
				<label>File</label>
				<input class="form-control" type="file" name="upload">
			</div>
			<br>
			<div class="input-group">
				<label>Type</label>
				<select class="form-control" name="type" required>
					<option value="tshirt">T-Shirt</option>
					<option value="shirt">Shirt</option>
					<option value="pants">Pants</option>
				</select>
			</div>
			<br>
			<div class="input-group">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div>
@endsection
