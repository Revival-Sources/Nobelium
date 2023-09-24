@extends('layouts.app')

@section('content')
	<div class="container">
		@if(!$item)
			<h3>Invalid ID!</h3>
			<p>No item exists with that ID. Oops?</p>
		@else
			@if(Session::has('flash_message'))
				<div class="alert alert-success center">{!! session('flash_message') !!}</div>
			@endif
			@if(Session::has('flash_message_error'))
				<div class="alert alert-danger center">{!! session('flash_message_error') !!}</div>
			@endif

			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<div class="panel-title">Nobelium {{ getAssetTypeFriendlyName($item->type) }}</div>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-8">
									<h4>{{ $item->name }} <small>by {{ \Illuminate\Foundation\Auth\User::where('id', $item->author)->first()->name }}</small></h4>
									<img src="{{ url('/catalog/getthumb/' . $item->id) }}" style="max-width:150px;" class="img-responsive">
									<br>
									<p class="no-tb-margin"><b>Description:</b></p>
									<p class="no-tb-margin">{{ $item->description }}</p>
								</div>
								<div class="col-md-4">
									@if(Auth::check() && Auth::user()->id == $item->author)
										<p><a href="{{ url('/item/' . $item->id . '/settings') }}" class="btn btn-default pull-right"><i class="fa fa-gear"></i></a></p>
										<br><br>
									@endif

									<div class="center well clearfix">
										<p><b>Price:</b> {{  $item->price }} Huefish</p>
										<hr>
										@if($item->forsale == 1)
											@if($asset)
												<p><b>You already own this asset.</b></p>
											@else
												<form method="post">
													{!! csrf_field() !!}
													<p><button type="submit" class="btn btn-primary btn-block btn-sm">Buy</button></p>
												</form>
											@endif
										@else
											<p><b>This item is not for sale.</b></p>
										@endif
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		@endif
	</div>
@endsection
