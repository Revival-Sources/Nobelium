@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-2">
				<div class="panel panel-default">
					<div class="panel-heading">
						Character
					</div>
					<div class="panel-body">
						<button type="button" class="btn btn-primary btn-block" id="regenBtn"><i class="fa fa-refresh"></i> Regen</button>
						<img src="{{ url('/user/currentthumb') }}" alt="Character image" class="img-responsive">
					</div>
				</div>
			</div>
			<div class="col-md-10">
				<div class="panel panel-default">
					<div class="panel-heading">
						<ul class="nav nav-tabs">
							<li role="presentation"{!! (!isset($type) ? ' class="active"' : '') !!}><a href="{{ url('/character') }}">Body Colors</a></li>
							<li role="presentation"{!! ($type == "hat" ? ' class="active"' : '') !!}><a href="{{ url('/character/hats') }}">Hats</a></li>
							<li role="presentation"{!! ($type == "tshirt" ? ' class="active"' : '') !!}><a href="{{ url('/character/tshirts') }}">T-Shirts</a></li>
							<li role="presentation"{!! ($type == "shirt" ? ' class="active"' : '') !!}><a href="{{ url('/character/shirts') }}">Shirts</a></li>
							<li role="presentation"{!! ($type == "pants" ? ' class="active"' : '') !!}><a href="{{ url('/character/pants') }}">Pants</a></li>
							<li role="presentation"{!! ($type == "face" ? ' class="active"' : '') !!}><a href="{{ url('/character/faces') }}">Faces</a></li>
							<li role="presentation"{!! ($type == "gear" ? ' class="active"' : '') !!}><a href="{{ url('/character/gear') }}">Gear</a></li>
						</ul>
					</div>
					<div class="panel-body">
						@foreach (array_chunk($assets->all(), 3) as $assetsRow)
							<div class="row">
								@foreach ($assetsRow as $asset)
									<div class="col-md-4">
										<div class="thumbnail">
											<img src="{{ url('/catalog/getthumb/' . $asset->id) }}" alt="Image" style="max-height:100px;max-width:100px;">
											<div class="caption">
												<p class="no-tb-margin">{{ $asset->name }}</p>
												<form method="post" action="{{ url('/character/toggle/' . $asset->id) }}">
													{!! csrf_field() !!}
													<p><button type="submit" class="btn btn-{{ ($asset->wearing) ? "danger" : "primary" }}">{{ ($asset->wearing) ? "Unequip" : "Equip" }}</button></p>
												</form>
											</div>
										</div>
									</div>
								@endforeach
							</div>
						@endforeach

						@if(count($assets) < 1)
							<p>No results were returned.</p>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('footer')
	<script>
		$(document).ready(function() {
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			})

			$('#regenBtn').click(function(evt) {
				var $t = $(this);
				$.ajax({
					type: "POST",
					url: "/user/regenthumb",
					success: function (msg){
						if(msg.startsWith("OK")) {
							$t.html("Regening");
							$t.addClass("disabled");
						} else {
							alert(msg);
						}
					}
				});
				evt.preventDefault();
				return false;
			});
		});
	</script>
@endsection