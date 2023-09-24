@extends('layouts.app')

@section('content')
	@if(Session::has('flash_message'))
		<div class="alert alert-success center">{!! session('flash_message') !!}</div>
	@endif

	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">Settings</div>

					<div class="panel-body">
						<p><b>Blurb:</b></p>
						<form action="{{ url('/settings/blurb') }}" method="post">
							{!! csrf_field() !!}
							<textarea name="blurb" class="form-control" style="width:100%;" rows="10" autocomplete="blurb-off">{{ old('blurb', \Illuminate\Support\Facades\Auth::user()->blurb) }}</textarea>
							<br>
							<input class="btn btn-primary btn-block" name="submit_blurb" type="submit" value="Change Blurb">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
