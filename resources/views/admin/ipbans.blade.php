@extends('layouts.app')

@section('content')
    <div class="container">
        <h3><a href="{{ url('/admin') }}">Admin Panel</a></h3>
        <h4>IP Bans</h4>

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(Session::has('flash_message'))
            <div class="alert alert-success center">{!! session('flash_message') !!}</div>
        @endif

        <p><a href="{{ url('/admin/ipbans/new') }}" class="btn btn-primary">New</a></p>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>IP</th>
                    <th>Date</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ipbans as $ip)
                    <tr>
                        <td>{{ $ip->ip }}</td>
                        <td>{{ $ip->created_at }}</td>
                        <td><a href="{{ url('/admin/ipbans/delete?id=' . $ip->id) }}">X</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
