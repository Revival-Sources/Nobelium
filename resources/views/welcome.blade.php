@extends('layouts.app')

@section('content')
@if(Session::has('flash_message'))
	<div class="alert alert-success center">{!! session('flash_message') !!}</div>
@endif

<div class="jumbotron center">
	<div class="container">
		<img src="{{ url('/img/nobelium logo i am asirexxale and i\'ve been binge watching steven universe for four hours please help my soul.png') }}" class="img-responsive" style="margin: 0 auto; max-width: 300px; max-height: 200px;" alt="Nobelium">
		<p>welcome to China&trade;</p>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-4 center well well-lg">
			<h4>95.5% less copyright</h4>
			<p>pls no dmca</p>
		</div>
		<div class="col-md-4 center well-lg">
			<h4>96.5% less copyright</h4>
			<p>pls no dmca</p>
		</div>
		<div class="col-md-4 center well well-lg">
			<h4>97.5% less copyright</h4>
			<p>pls no dmca</p>
		</div>
	</div>
</div>
@endsection
