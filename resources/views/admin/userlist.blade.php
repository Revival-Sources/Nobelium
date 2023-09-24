@extends('layouts.app')

@section('header')
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/u/bs/dt-1.10.12,b-1.2.0,r-2.1.0,sc-1.4.2/datatables.min.css">
	<script type="text/javascript" src="https://cdn.datatables.net/u/bs/dt-1.10.12,b-1.2.0,r-2.1.0,sc-1.4.2/datatables.min.js"></script>
@endsection

@section('content')
	<div class="container">
		<h3><a href="{{ url('/admin') }}">Admin Panel</a></h3>
		<h4>Users</h4>

		@if(Session::has('flash_message'))
			<div class="alert alert-success center">{!! session('flash_message') !!}</div>
		@endif

		<table class="table table-striped">
			<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>E-mail</th>
				<th>Registration IP</th>
				<th>Registration Time</th>
				<th>Last IP</th>
				<th>Last Visit</th>
				<th>Ban</th>
			</tr>
			</thead>
			<tbody>
			@foreach($users as $user)
				<tr>
					<td>{{ $user->id }}</td>
					<td>{{ $user->name }}
					<td>{{ $user->email }}</td>
					<td>{{ ($user->registration_ip ? $user->registration_ip : "N/A") }}</td>
					<td>{{ ($user->created_at ? $user->created_at : "N/A") }}</td>
					<td>{{ ($user->last_ip ? $user->last_ip : "N/A") }}</td>
					<td>{{ (strtotime($user->last_money_collect_time) != 1463962704 ? $user->last_money_collect_time : "Never logged in") }}</td>
					<td><button class="btn btn-{{ ($user->banned) ? "danger" : "primary" }} btn-sm banBtn" data-user-name="{{ $user->name }}">{{ ($user->banned) ? "Unban" : "Ban" }}</button></td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
@endsection

@section('footer')
	<script>
		$('table').DataTable();

		$.ajaxSetup({
			headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
		});

		$('body').on('click', '.banBtn', function (){
			$btn = $(this);

			$btn.removeClass('btn-primary').removeClass('btn-danger').addClass('btn-default');
			$btn.html('Processing');

			$.ajax({
				url: "{{ url('/admin/users/toggleban') }}",
				data: {
					"user": $btn.data('user-name')
				},
				type: "POST",
				success: function (data) {
					if(data == "B") {
						// set to ban button
						$btn.removeClass('btn-default').addClass('btn-primary').html('Ban');
					} else if(data == "U") {
						// set to unban
						$btn.removeClass('btn-default').addClass('btn-danger').html('Unban');
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
		});
	</script>
@endsection