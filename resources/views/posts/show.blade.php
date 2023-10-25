<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>sunrise</title>
        <link  rel="stylesheet" href="/css/style.css">
    </head>
    
    <body>
        <h1>投稿詳細</h1>
        
        <div id="map" class="map"></div>
        
        <div class="posts">
            <img src="{{ $post->image_url }}" class="image" alt="画像が読み込めません。"/>
            <h1 class="title">地名：{{ $post->title }}</h1>
            <h1 class="body">本文：{{ $post->body }}</h1>
        </div>
        
        <div class = "edit">
            <a href="/posts/{{$post->id}}/edit">編集</a>
        </div>
        
        <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
            @csrf
            @method('DELETE')
            <button type="button" onclick="deletePost({{ $post->id }})">削除</button> 
        </form>
        
        <div class="footer">
            <a href="/">戻る</a>
        </div>
        
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPD2t5vZx1y4Qq71BZOjSAhsPwugj2d8Q"></script>
        <script>
            
            var map;
            var marker;
            var geocoder;
        
            var address = '{{$post->prefecture}}{{$post->city}}{{$post->after_address}}';
            
            function initMap(){
                geocoder = new google.maps.Geocoder();
                geocoder.geocode( {'address': address}, function(results, status) {
                    if (status === 'OK'&& results[0]) {
                        
                    
                        map = new google.maps.Map(document.getElementById('map'),{
                            center: results[0].geometry.location,
                            zoom: 8 // 地図のズームを指定
                        });
                        
                        console.log(results[0]);
                        
                        marker = new google.maps.Marker({
                            map: map,
                            position: results[0].geometry.location,
                        });
                    } else{ 
                        //住所が存在しない場合の処理
                        alert('住所が正しくないか存在しません。');
                        target.style.display='none';
                    }
                });
            }
            initMap();
        </script>
        <script>
            function deletePost(id) {
                'use strict'
                if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
        </script>
    </body>
</html>