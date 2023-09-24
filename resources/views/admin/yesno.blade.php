@extends('layouts.app')

@section('content')
    <div class="container">
        <h3><a href="{{ url('/admin') }}">Admin Panel</a></h3>
        <h4><a href="{{ url('/admin/yesno') }}">Yes/No Decider</a></h4>

        <br>

        @if($result)
            <h1>YES</h1>
        @else
            <h1>NO</h1>
        @endif
    </div>
@endsection
