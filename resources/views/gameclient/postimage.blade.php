<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name  ="csrf-token" content="{{ csrf_token() }}">
        <title>RBLXhue</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ url('/css/bootstrap.paper.min.css') }}">
        <link rel="stylesheet" href="{{ url('/css/main.css') }}">
    </head>
    <body>
        <div class="container">
            <h3>Screenshot</h3>
            <p>You took a screenshot. <a href="#" onclick="window.external.OpenPicFolder();">Some people can click this to open the Pictures folder.</a></p>
            <p><a href="#" onclick="if ('True' == 'True') window.external.PostImage(false, 0, 0, 0); else window.external.PostImage(false, 0); window.close(); return false;">Some people can click this to never show this again</a></p>
        </div>
    </body>
</html>