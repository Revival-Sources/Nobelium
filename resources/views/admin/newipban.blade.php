@extends('layouts.app')

@section('content')
    <div class="container">
        <h3><a href="{{ url('/admin') }}">Admin Panel</a></h3>
        <h4><a href="{{ url('/admin/ipbans') }}">IP Bans</a> - New</h4>

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="post">
            {!! csrf_field() !!}

            <div class="input-group">
                <input type="text" class="form-control" name="ip" placeholder="IP to ban" value="{{ Request::old('ip') }}" required>
            </div>
            <br>
            <div class="input-group">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection
