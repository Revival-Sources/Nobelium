@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">New Game</div>

					<div class="panel-body">
						@if (count($errors) > 0)
							<div class="alert alert-danger">
								<ul>
									@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
						@endif

						<p>You will get a link to the server script after you submit the form.</p>

						<form method="post">
							{!! csrf_field() !!}

							<div class="input-group">
								<label>Name</label>
								<input type="text" class="form-control" name="name" placeholder="Game name" value="{{ Request::old('name') }}" required>
							</div>
							<br>
							<div class="input-group">
								<label>Description</label>
								<textarea name="description" class="form-control" rows="5" cols="60" placeholder="Game description (optional)">{{ Request::old('description') }}</textarea>
							</div>
							<br>
							<div class="input-group">
								<label>IP address</label>
								<button id="fillIP" class="btn btn-default btn-sm">Use Current IP</button>
								<input type="text" class="form-control" name="ip" id="ip_addr" placeholder="Game IP" value="{{ Request::old('ip') }}" required>
							</div>
							<br>
							<div class="input-group">
								<label>Port</label>
								<input type="text" class="form-control" name="port" placeholder="Game port" value="{{ Request::old('port', '53640') }}" required>
							</div>
							<br>
							<div class="input-group">
								<button type="submit" class="btn btn-primary">Submit</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('footer')
	<script>
		$('#fillIP').click(function(evt) {
			$('#ip_addr').val("{{ Request::ip() }}");
			evt.preventDefault();
			return false;
		});
	</script>
@endsection
