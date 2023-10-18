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
        
        <div id="map"></div>
        
        <div class="index">
            <h2>投稿一覧</h2>
            @foreach($posts as $post)
                <div class="posts">
                    <div class="image">
                        <img src="{{ $post->image_url }}" alt="画像が読み込めません。"/>
                    </div>
                    
                    <h1 class='title'>地名：
                        <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                    </h1>
                    <h1 class='body'>
                        <p>{{ $post->body }}</p>
                    </h1>
                    
                </div>
            @endforeach
        </div>
        
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPD2t5vZx1y4Qq71BZOjSAhsPwugj2d8Q"></script>
        <script>
            var map;
            var marker;
            const position = {
                lat: 35.65638, // 緯度
                lng: 139.30782 // 経度
            };
            
            function initMap(){
                map = new google.maps.Map(document.getElementById('map'),{
                    center: position,
                    zoom: 8 // 地図のズームを指定
                });
                
                marker = new google.maps.Marker({
                    map: map,
                    position: position,
                });
            }
            initMap();
        </script>
    </body>
</html>