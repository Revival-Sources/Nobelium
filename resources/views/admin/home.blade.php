@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Admin Panel</h3>
        @if(!in_array(Auth::user()->name, $limited))
            <p>- <a href="{{ url('/admin/ipbans') }}">IP bans</a></p>
            <p>- <a href="{{ url('/admin/users') }}">Users</a></p>
        @endif
        <p>- <a href="{{ url('/admin/assets') }}">Assets</a></p>
        <p>- <a href="{{ url('/admin/yesno') }}">Yes/No Decider</a></p>
    </div>
@endsection
