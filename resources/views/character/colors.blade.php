@extends('layouts.app')

@section('header')
	<style>
		.back-color {
			margin: 0 auto;
			background-color: #fff;
			border: 1px #000 solid;
			width: auto;
			max-width: 386px;
			display: block;
		}
		.color {
			height: 40px;
			width: 40px;
			border-color: #666666;
			border-style: solid;
			border-width: 1px;
			display: inline-block;
			padding: 2px;
			margin: 4px;
		}
		.color:hover {
			border: 2px rgb(160, 160, 160) solid;
		}
		.table-color {
			border-width: 0px;
			border-collapse: collapse;
		}
		.h3-color {
			font-family: RobotoDraft, Roboto, Arial, sans-serif;
			margin: 4px;
			text-align: center;
		}
		.hover {
			cursor: pointer;
		}
		.ColorChooserRegion {
			border: 1px solid #666666;
		}
	</style>
@endsection

@section('content')
	<div class="modal fade" id="colorPicker" tabindex="-1" role="dialog" aria-labelledby="colorPickerLbl">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="colorPickerLbl">Color Picker</h4>
				</div>
				<div class="modal-body">
					<div class="back-color">
						<h3 class="h3-color">Select a Color</h3>
						<table class="table-color">
							<tbody>
							<tr>
								@foreach($codes as $i => $v)
										<td data-toggle="tooltip" data-placement="left" title="{{ $names[$i] }}" onclick="sendColorReq({{ $codes[$i] }})" class="color" style="background-color: rgb({{ $rgbvals[$i] }}); color: rgb({{ $rgbvals[$i] }});"> </td>
								@endforeach
							</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

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
							<li role="presentation" class="active"><a href="{{ url('/character') }}">Body Colors</a></li>
							<li role="presentation"><a href="{{ url('/character/hats') }}">Hats</a></li>
							<li role="presentation"><a href="{{ url('/character/tshirts') }}">T-Shirts</a></li>
							<li role="presentation"><a href="{{ url('/character/shirts') }}">Shirts</a></li>
							<li role="presentation"><a href="{{ url('/character/pants') }}">Pants</a></li>
							<li role="presentation"><a href="{{ url('/character/faces') }}">Faces</a></li>
							<li role="presentation"><a href="{{ url('/character/gear') }}">Gear</a></li>
						</ul>
					</div>
					<div class="panel-body">
						<div class="well table-responsive">
							<div style="height:240px;width:194px;text-align:center;margin:0 auto;">
								<div style="position: relative; margin: 11px 4px; height: 1%;">
									<div style="position: absolute; left: 72px; top: 0px; cursor: pointer">
										<div class="ColorChooserRegion" data-toggle="modal" id="HeadCP" data-target="#colorPicker" style="background-color:rgb({{ $rgbvals[array_search($colors->head_color, $codes)] }});height:44px;width:44px;"> </div>
									</div>
									<div style="position: absolute; left: 0px; top: 52px; cursor: pointer">
										<div class="ColorChooserRegion" data-toggle="modal" id="LArmCP" data-target="#colorPicker" style="background-color:rgb({{ $rgbvals[array_search($colors->left_arm_color, $codes)] }});height:88px;width:40px;"> </div>
									</div>
									<div style="position: absolute; left: 48px; top: 52px; cursor: pointer">
										<div class="ColorChooserRegion" data-toggle="modal" id="TorsoCP" data-target="#colorPicker" style="background-color:rgb({{ $rgbvals[array_search($colors->torso_color, $codes)] }});height:88px;width:88px;"> </div>
									</div>
									<div style="position: absolute; left: 144px; top: 52px; cursor: pointer">
										<div class="ColorChooserRegion" data-toggle="modal" id="RArmCP" data-target="#colorPicker" style="background-color:rgb({{ $rgbvals[array_search($colors->right_arm_color, $codes)] }});height:88px;width:40px;"> </div>
									</div>
									<div style="position: absolute; left: 48px; top: 146px; cursor: pointer">
										<div class="ColorChooserRegion" data-toggle="modal" id="LLegCP" data-target="#colorPicker" style="background-color:rgb({{ $rgbvals[array_search($colors->left_leg_color, $codes)] }});height:88px;width:40px;"> </div>
									</div>
									<div style="position: absolute; left: 96px; top: 146px; cursor: pointer">
										<div class="ColorChooserRegion" data-toggle="modal" id="RLegCP" data-target="#colorPicker" style="background-color:rgb({{ $rgbvals[array_search($colors->right_leg_color, $codes)] }});height:88px;width:40px;"> </div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('footer')
	<script>
		var bodyPart = "";
		var main = function() {
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			})

			$(".color").hover(function() {
				$(this).addClass('hover');
			});
			$(".color").mouseout(function() {
				$('.color').removeClass('hover');
			});

			// Worst code in the history of code:
			$("#HeadCP").click(function() {
				bodyPart = "head";
			});
			$("#LArmCP").click(function() {
				bodyPart = "larm";
			});
			$("#TorsoCP").click(function() {
				bodyPart = "torso";
			});
			$("#RArmCP").click(function() {
				bodyPart = "rarm";
			});
			$("#LLegCP").click(function() {
				bodyPart = "lleg";
			});
			$("#RLegCP").click(function() {
				bodyPart = "rleg";
			});

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
		}

		function sendColorReq(color) {
			if(!bodyPart) { return; }

			var request = $.ajax({
				url: "/user/changecolor",
				method: "POST",
				data: { "color": color, "part": bodyPart },
				dataType: "html"
			});

			request.done(function( msg ) {
				if(bodyPart == "torso") {
					$("#TorsoCP").css('background-color', "rgb(" + msg + ")");
				}
				if(bodyPart == "head") {
					$("#HeadCP").css('background-color', "rgb(" + msg + ")");
				}else if(bodyPart == "larm") {
					$("#LArmCP").css('background-color', "rgb(" + msg + ")");
				}else if(bodyPart == "rarm") {
					$("#RArmCP").css('background-color', "rgb(" + msg + ")");
				}else if(bodyPart == "lleg") {
					$("#LLegCP").css('background-color', "rgb(" + msg + ")");
				}else if(bodyPart == "rleg") {
					$("#RLegCP").css('background-color', "rgb(" + msg + ")");
				}
				$("#colorPicker").modal('hide');
			}).fail(function(jqXHR, textStatus) {
				alert("Request to color system failed.");
			});
		}
		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		})
		$(document).ready(main);
	</script>
@endsection
