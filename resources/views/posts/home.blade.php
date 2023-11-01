<head>
    <link rel="stylesheet" href="{{ asset('/css/style.css')  }}" >
</head>

<x-app-layout>
    <x-slot name="header">
        全ての投稿
    </x-slot>
        <div class="btn">
            <a href="/create">投稿</a>
        </div>
        <div id="map"></div>

        
        <h2>投稿一覧</h2>
        <div class="container">
            @foreach($posts as $post)
                <div class="item-row">
                    <img src="{{ $post->image_url }}" alt="画像が読み込めません。" class="item-image"/>
                    <div class="text-content">
                        <a href="/posts/{{ $post->user_id }}/home" class="item-user">{{ $post->user->name }}</a>
                        <a href="/posts/{{ $post->id }}" class="item-title">{{ $post->title }}</a>
                        {{--<a href="/posts/{{ $post->id }}" id="item-address">{{ $post->prefecture }}{{ $post->city }}{{ $post->after_address }}</p>--}}
                    </div>
                </div>
            @endforeach
        </div>
        
        
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPD2t5vZx1y4Qq71BZOjSAhsPwugj2d8Q"></script>
        <script>
            let map;
            let marker;
            const position = {
                lat: 35.65638, // 緯度
                lng: 139.30782 // 経度
            };
            var markerData = @json($address_list);
            var placeData = @json($place_list);
            
            function initMap(){
                map = new google.maps.Map(document.getElementById('map'),{
                    center: position,
                    zoom: 8 // 地図のズームを指定
                });
                
                for(let i=0; i<markerData.length; i++){
                    console.log(i);
                    geocoder = new google.maps.Geocoder();
                    geocoder.geocode( {'address': markerData[i]}, function(results, status) {
                        if (status === 'OK'&& results[0]) {
                            console.log(results[0]);
                            marker = new google.maps.Marker({
                                map: map,
                                position: results[0].geometry.location,
                                animation: google.maps.Animation.DROP
                            });
                            
                            console.log(i);
                            attachMessage(marker,placeData[i]);
                        }
                    });
                }
            }
            
            function attachMessage(marker, msg) {
                google.maps.event.addListener(marker, 'click', function(event) {
                    new google.maps.InfoWindow({
                    content: msg
                    }).open(marker.getMap(), marker);
                });
            }
            
            
            console.log(placeData);
            
            initMap();
        </script>
</x-app-layout>