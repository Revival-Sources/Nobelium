@extends('layouts.app')

@section('content')
    <div class="container">
        @if($game)
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">{{ $game->name }}</div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <h4>{{ $game->name }} <small>by <a href="{{ url('/user', $game->author) }}"}}">{{ App\User::find($game->author)->name }}</a> [2010]</small></h4>
                                    <p class="no-tb-margin"><b>Description: </b></p>
                                    <p class="no-tb-margin">{{ $game->description }}</p>
                                    @if($server)
                                        <br>
                                        <b>To start your server, put this in a new server window's command bar:</b>
                                        <code>
                                            dofile("{{ url('/server/getscript/' . $game->id . '+' . $game->api_key) }}")
                                        </code>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <a href="#" id="startGame" class="btn btn-success btn-block">Play</a>
                                    <a href="{{ url('/games/') }}" class="btn btn-primary btn-block">Back to Server List</a>
                                    @if(Auth::user()->id == $game->author || Auth::user()->name == "Raymonf")
                                        <span class="four-tb-margin"></span>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <a href="{{ url('/game/delete/' . $game->id) }}" class="btn btn-danger btn-block">Delete</a>
                                            </div>
                                            <div class="col-md-6">
                                                <a href="{{ url('/game/' . $game->id . '/server') }}" class="btn btn-default btn-block">Server</a>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <h3>Invalid ID!</h3>
            <p>Well, we couldn't figure out this ID, but fear not! Simply go back to the last page and try again!</p>
        @endif
    </div>
@endsection

@section('footer')
    @if($game)
        <script>
            $( "#startGame" ).click(function() {
                $('#startGame').addClass('disabled');
                xmlhttp = new XMLHttpRequest();
                xmlhttp.open("GET","{{ url('/user/gettoken/' . $game->id) }}", false);
                xmlhttp.send();
                var authticket = xmlhttp.responseText;
                $('#startGame').html('Game Launched');
                var i = document.createElement('iframe');
                i.style.display = 'none';
                i.id = 'startframe';
                i.onload = function() { i.parentNode.removeChild(i); };
                i.src = 'rblxhueten://{{ $game->id }}+' + authticket + '/';
                document.body.appendChild(i);
                setTimeout(function() {
                    $('#startGame').removeClass('disabled');
                    $('#startGame').html('Play');
                }, 7000);
            });
        </script>
    @endif
@endsection