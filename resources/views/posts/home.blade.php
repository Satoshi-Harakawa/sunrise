<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>sunrise</title>
        <link  rel="stylesheet" href="/css/style.css">
    </head>
    
    <body>
        <h1>日の出</h1>
        <div class="create">
            <a href="/create">投稿</a>
        </div>
        
        <div id="map-canvas"></div>
        
        <div class="index">
            <h2>投稿一覧</h2>
            @foreach($posts as $post)
                <div class="post">
                    <img src="{{$post->image_url}}" class="image" alt="画像が読み込めません。"/>
                    <h2>{{$post->title}}</h2>
                    <p>{{$post->body}}</p>
                </div>
            @endforeach
        </div>
        
        <script src="//maps.googleapis.com/maps/api/js?key=AIzaSyAPD2t5vZx1y4Qq71BZOjSAhsPwugj2d8Q&libraries=geometry,drawing,places"></script>
        
        <script>
            var mapDiv = document.getElementById( "map-canvas" ) ;
            
            var map = new google.maps.Map( mapDiv, {
            center: new google.maps.LatLng( 36 , 139 ) ,
            zoom: 8 ,
            });
        </script>
    </body>
</html>