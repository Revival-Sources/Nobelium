@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">User List</div>

					<div class="panel-body">
						<form class="form-horizontal" method="get">
							<div class="form-group">
								<label class="col-md-4 control-label" for="search">Search User</label>
								<div class="col-md-5">
									<input id="search" name="q" type="text" class="form-control" required="">
								</div>
								<div class="col-md-3">
									<button type="submit" class="btn btn-primary">Submit</button>
								</div>
							</div>
						</form>

						{!! $backtext !!}

						@foreach($users as $user)
							<div class="well well-sm center">
								<a href="{{ url('/user/' . $user->id) }}">
									<img src="{{ url('/user/getthumb/' . $user->id) }}" height="45" width="30">
									{{ $user->name }}
								</a>
								<span class="text-muted">{{ str_limit($user->blurb, $limit = 12, $end = '...') }}</span>
								{{ \Carbon\Carbon::createFromTimestamp(strtotime($user->last_visit))->format('n/j/Y g:i:sa') }}
							</div>
						@endforeach

						@if(count($users) < 1)
							<p>No results were found.</p>
						@endif

						<div class="center">
							{!! $users->appends(request()->capture()->except('page'))->render() !!}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
