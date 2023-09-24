@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Delete Game</div>

                    <div class="panel-body">
                        @if($status == 1)
                            <form method="post" class="center">
                                {!! csrf_field() !!}

                                <p>Do you really want to delete <b>{{ $game->name }}</b>?</p>
                                <p><button type="submit" class="btn btn-danger full-width d-block">Confirm Delete</button></p>
                                <p><a href="{{ url('/games') }}" class="btn btn-primary full-width d-block">Return to Games List</a></p>
                            </form>
                        @else
                            <p>Nope.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
