<head>
    <link rel="stylesheet" href="{{ asset('/css/style.css')  }}" >
</head>

<x-app-layout>
    <x-slot name="header">
        ホーム
    </x-slot>
        <h1 class="title">日の出</h1>
        <div class="create">
            <a href="/create">投稿</a>
        </div>
        
        <div id="map"></div>
            <h2>の投稿一覧<h2>
        <div class="index">
            @foreach($posts as $post)
                <div class="posts">
                    <div class="image">
                        <img src="{{ $post->image_url }}" alt="画像が読み込めません。"/>
                    </div>
                    
                    <a href="/posts/{{ $post->user_id }}" class='user_name'>{{ $post->user->name }}</a>
                    {{--<h1 class='title'>地名：
                        <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                    </h1>--}}
                    
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
            var markerData = @json($address_list);
            
            function initMap(){
                map = new google.maps.Map(document.getElementById('map'),{
                    center: position,
                    zoom: 8 // 地図のズームを指定
                });
                
                for(var i=0; i<markerData.length; i++){
                    geocoder = new google.maps.Geocoder();
                    geocoder.geocode( {'address': markerData[i]}, function(results, status) {
                        if (status === 'OK'&& results[0]) {
                            marker[i] = new google.maps.Marker({
                                map: map,
                                position: results[0].geometry.location,
                            });
                        }
                    });
                }
            }
            initMap();
        </script>
</x-app-layout>