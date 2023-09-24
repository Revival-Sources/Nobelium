@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">

	            <div class="panel panel-primary row">
		            <div class="panel-heading">
			            Select Version
		            </div>
		            <div class="panel-body">
			            <a href="{{ url('/games') }}" class="btn btn-primary">All</a>
		            </div>
	            </div>

                @if(!$games->isEmpty())
					@foreach ($games->all() as $game)
						<div class="panel panel-default">
							<div class="row panel-body">
								<div class="col-md-8 gameleft">
									<a href="/user/4">
										<img src="{{ url('/user/getthumb', $game->author) }}" width="80" height="120" style="float: left" class="marg">
									</a>
									<h5 class="push-down mov"><a href="{{ url('/game/' . $game->id) }}">{{ $game->name }}</a></h5>
									<p class="mov"><b>Creator:</b> <a href="{{ url('user', $game->author) }}">{{ App\User::find($game->author)->name }}</a></p>
									<p class="mov"><b>Date:</b> {{ date('n/j/Y g:i:s a', strtotime($game->created_at)) }}</p>
									<p class="mov"><b>Version:</b> 2010</p>
									<p><b>Status:</b> {!! ($game->getOnlineStatus()) ? 'Online | <i class="fa fa-user"></i> ' . $game->playing : 'Offline' !!}</p>
								</div>
								<div class="col-md-4 pad">
									@if(Auth::user()->id == $game->author || Auth::user()->name == "Raymonf")
										<p><a href="{{ url('/game', $game->id) }}" class="btn btn-success full-width fnheight">Details</a></p>
										<p><a class="btn btn-danger full-width fnheight" href="{{ url('/game/delete', $game->id) }}">Delete</a></p>
									@else
										<p><a href="{{ url('/game', $game->id) }}" class="btn btn-success full-width full-height">Details</a></p>
									@endif
								</div>
							</div>
						</div>
					@endforeach

					{{-- @foreach ($games as $game)
						<div class="well well-sm">
							<div class="row">
								<div class="col-md-6">
									<p class="no-tb-margin"><a href="{{ url('/game/' . $game->id) }}">{{ $game->name }}</a> by {{ App\User::find($game->author)->name }}</p>
									<p class="no-tb-margin"><b>Created:</b> {{ date('n/j/Y g:i:s a', strtotime($game->created_at)) }}</p>
									<p class="no-tb-margin"><b>Status:</b> {!! ($game->getOnlineStatus()) ? 'Online | <i class="fa fa-user"></i> ' . $game->playing : 'Offline' !!}</p>
								</div>
								<div class="col-md-6">
									<a href="{{ url('/game/' . $game->id) }}" class="btn btn-info btn-block">Show Details</a>
									@if(Auth::user()->id == $game->author || Auth::user()->name == "Raymonf")
										<a href="{{ url('/game/delete/' . $game->id) }}" class="btn btn-danger btn-block">Delete</a>
									@endif
								</div>
							</div>
						</div>
					@endforeach --}}
                @else
                    <p>There are no active games right now.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
