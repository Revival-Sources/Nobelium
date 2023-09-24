@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-2">
				<div class="panel panel-default">
					<div class="panel-heading">
						Sidebar
					</div>
					<div class="panel-body">
						<p><a href="{{ url('/catalog/new') }}" class="btn btn-primary btn-block"><i class="fa fa-plus f-btn"></i>New</a></p>
						<p><b>Type:</b></p>
						<ul>
							<li><a href="{{ url('/catalog/hats') }}"{!! ($type == "hat" ? ' class="link-active"' : '') !!}>Hats</a></li>
							<li><a href="{{ url('/catalog/tshirts') }}"{!! ($type == "tshirt" ? ' class="link-active"' : '') !!}>T-Shirts</a></li>
							<li><a href="{{ url('/catalog/shirts') }}"{!! ($type == "shirt" ? ' class="link-active"' : '') !!}>Shirts</a></li>
							<li><a href="{{ url('/catalog/pants') }}"{!! ($type == "pants" ? ' class="link-active"' : '') !!}>Pants</a></li>
							<li><a href="{{ url('/catalog/faces') }}"{!! ($type == "face" ? ' class="link-active"' : '') !!}>Faces</a></li>
							<li><a href="{{ url('/catalog/gear') }}"{!! ($type == "gear" ? ' class="link-active"' : '') !!}>Gear</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-10">
				@if(count($assets) < 1)
					<p>No results were returned.</p>
				@endif

				@foreach (array_chunk($assets->all(), 3) as $assetsRow)
					<div class="row same-row">
						@foreach ($assetsRow as $asset)
							<div class="col-md-4">
								<div class="thumbnail">
									<img src="{{ url('/catalog/getthumb/' . $asset->id) }}" alt="Image" style="max-height:100px;max-width:100px;">
									<div class="caption">
										<p class="no-tb-margin">{{ $asset->name }}</p>
										<p class="no-tb-margin"><i class="fa fa-user"></i> {{ \App\User::where('id', $asset->author)->first()->name }}</p>
										<p class="no-tb-margin"><i class="fa fa-money"></i> {{  $asset->price }}</p>
										<p><a class="btn btn-primary" href="/item/{{ $asset->id }}">Details</a></p>
									</div>
								</div>
							</div>
						@endforeach
					</div>
				@endforeach

				{!! $assets->render() !!}
			</div>
		</div>
	</div>
@endsection
