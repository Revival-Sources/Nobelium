@extends('layouts.app')

@section('content')
	<div class="container">
		@if(!$user)
			<h3>What are you exactly looking for?</h3>
			That is, you requested an invalid user.
		@else
			<div class="row">
				<div class="col-md-5 center">
					<div class="panel panel-{{ $paneltype or 'primary' }}">
						<div class="panel-heading">
							<div class="panel-title">
								{{ $user->name }}
							</div>
						</div>
						<div class="panel-body">
							<img src="{{ url('/user/getthumb/' . $user->id) }}" class="img-responsive" style="max-height:250px;max-width:150px;margin:0 auto">
							@if(!empty($user->blurb))
								<blockquote style="text-align:left;word-break:break-word;font-size:12px">
									{{ $user->blurb }}
								</blockquote>
							@endif
							<hr>
							<p><b>Join Date:</b> {{ \Carbon\Carbon::createFromTimestamp(strtotime($user->created_at))->format('n/j/Y g:i:sa') }}</p>
						</div>
					</div>
				</div>
				<div class="col-md-7">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<div class="panel-title center">
								Games
							</div>
						</div>
						<div class="panel-body">
							@if(\App\Game::where('author', $user->id)->count() > 0)
								@foreach(\App\Game::where('author', $user->id)->get() as $game)
									<div class="well well-sm">
										<div class="row">
											<div class="col-md-7">
												<p class="no-tb-margin"><a href="{{ url('/game/' . $game->id) }}">{{ $game->name }}</a></p>
												<p class="no-tb-margin"><b>Created:</b> {{ date('n/j/Y g:i:s a', strtotime($game->created_at)) }}</p>
												<p class="no-tb-margin"><b>Version:</b> 2010</p>
												<p class="no-tb-margin"><b>Status:</b> {!! ($game->getOnlineStatus()) ? 'Online | <i class="fa fa-user"></i> ' . $game->playing : 'Offline' !!}</p>
											</div>
											<div class="col-md-5">
												<a href="{{ url('/game/' . $game->id) }}" class="btn btn-success btn-block">Show Details</a>
												@if(Auth::user()->id == $game->author || Auth::user()->name == "Raymonf")
													<a href="{{ url('/game/delete/' . $game->id) }}" class="btn btn-danger btn-block">Delete</a>
												@endif
											</div>
										</div>
									</div>
								@endforeach
							@else
								This user doesn't have any servers available.
							@endif
						</div>
					</div>
				</div>
			</div>
		@endif
	</div>
@endsection
