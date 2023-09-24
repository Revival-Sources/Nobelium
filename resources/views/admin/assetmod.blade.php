@extends('layouts.app')

@section('content')
	<div class="container">
		<h3><a href="{{ url('/admin') }}">Admin Panel</a></h3>
		<h4>Asset Moderation</h4>
		<p><a href="{{ ($show_type == "all") ? url('/admin/assets?type=nonapproved') : url('/admin/assets') }}">{{ ($show_type == "all") ? "Show unmoderated only" : "Show all" }}</a></p>

		@foreach (array_chunk($assets->all(), 3) as $assetsRow)
			<div class="row">
				@foreach ($assetsRow as $asset)
					<div class="col-md-4">
						<div class="thumbnail">
							<img src="{{ url('/catalog/getthumb/' . $asset->id . '/?nomod=true') }}" alt="Image" style="max-height:100px;max-width:100px;">
							<div class="caption">
								<p class="no-tb-margin">[{{ getAssetTypeFriendlyName($asset->type) }}] {{ $asset->name }}</p>
								<p class="no-tb-margin"><i class="fa fa-user"></i> {{ \App\User::where('id', $asset->author)->first()->name }}</p>
								<p class="no-tb-margin"><i class="fa fa-money"></i> {{  $asset->price }}</p>
								<p class="no-tb-margin"><i class="fa fa-clock-o"></i> {{  $asset->created_at }}</p>
								@if($asset->moderated == 0)
									<i class="fa fa-question approvalStatus" style="color:black;"> </i>
								@elseif($asset->moderated == 1)
									<i class="fa fa-check approvalStatus" style="color:green;"> </i>
								@else
									<i class="fa fa-times approvalStatus" style="color:red;"> </i>
								@endif
								<p><button class="btn btn-danger disallowBtn" data-asset-id="{{ $asset->id }}">Disapprove</button> <button class="btn btn-success allowBtn" data-asset-id="{{ $asset->id }}">Approve</button></p>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		@endforeach

		@if(count($assets->all()) < 1)
			<p>Nothing needs to be done.</p>
		@endif
	</div>
@endsection

@section('footer')
	<script>
		$.ajaxSetup({
			headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
		});

		function modAsset(asset, action)
		{
			$.ajax({
				url: "{{ url('/admin/assets/changestatus') }}",
				data: {
					"asset": asset,
					"action": action
				},
				type: "POST",
				success: function (data) {
					if(data == "D" || data == "A") {
						return data;
					} else {
						alert(data);
					}
				}
			}).fail(function(xhr, status, errorThrown) {
				alert("Sorry, there was a problem!");
				console.log("Error: " + errorThrown);
				console.log("Status: " + status);
				console.dir(xhr);
			})
		}

		$('body').on('click', '.disallowBtn', function (){
			$btn = $(this);
			modAsset($btn.data('asset-id'), "D");
			$(this).closest('.caption').children('.approvalStatus').removeClass('fa-question').removeClass('fa-check').removeClass('fa-times').addClass('fa-times').css('color', 'red');
			return false;
		});

		$('body').on('click', '.allowBtn', function (){
			$btn = $(this);
			modAsset($btn.data('asset-id'), "A");
			$btn.closest('.caption').children('.approvalStatus').removeClass('fa-question').removeClass('fa-check').removeClass('fa-times').addClass('fa-check').css('color', 'green');
			return false;
		});
	</script>
@endsection