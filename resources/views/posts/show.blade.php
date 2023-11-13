<head>
    <link rel="stylesheet" href="{{ asset('/css/show_style.css')  }}" >
</head>

<x-app-layout>
    <x-slot name="header">
        　投稿詳細
    </x-slot>
    <div class="title-text">
        <p>投稿詳細</p>
    </div>
    
    <div class="container">
        <div class="image-container">
            <img src="{{ $post->image_url }}" alt="画像が読み込めません。" class="item-image"/>
        </div>
        <div class="googlemap">
            <div id="map"></div>
        </div>
    </div>
    
    <div class="item-row">
        <div class="text-content">
            <p class="item-title">{{ $post->title }}</p>
            <p class="item-body">{{ $post->body }}</p>
        </div>
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
        
        let map;
        let marker;
        let geocoder;
        let address = '{{$post->prefecture}}{{$post->city}}{{$post->after_address}}';
        
        function initMap(){
            geocoder = new google.maps.Geocoder();
            geocoder.geocode( {'address': address}, function(results, status) {
                if (status === 'OK'&& results[0]) {
                    
                    map = new google.maps.Map(document.getElementById('map'),{
                        center: results[0].geometry.location,
                        zoom: 8 // 地図のズームを指定
                    });
                    
                    marker = new google.maps.Marker({
                        map: map,
                        position: results[0].geometry.location,
                        animation: google.maps.Animation.DROP
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
</x-app-layout>
