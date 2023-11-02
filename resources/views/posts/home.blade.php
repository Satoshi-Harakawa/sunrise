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
            let markerData = @json($address_list);
            let placeData = @json($place_list);
            let userData = @json($user_list);
            let postIdData = @json($post_id_list);
            
            function initMap(){
                map = new google.maps.Map(document.getElementById('map'),{
                    center: position,
                    zoom: 6 // 地図のズームを指定
                });
                
                for(let i=0; i<markerData.length; i++){
                    geocoder = new google.maps.Geocoder();
                    geocoder.geocode( {'address': markerData[i]}, function(results, status) {
                        if (status === 'OK'&& results[0]) {
                            marker = new google.maps.Marker({
                                map: map,
                                position: results[0].geometry.location,
                                animation: google.maps.Animation.DROP
                            });
                            attachMessage(marker,placeData[i],markerData[i],userData[i],postIdData[i]);
                        }
                    });
                }
            }
            
            function attachMessage(marker,msg1,msg2,msg3,msg4) {
                google.maps.event.addListener(marker, 'click', function(event) {
                    infowindow = new google.maps.InfoWindow({
                        content: '地名：'+msg1+'<br>'+'住所：'+msg2+'<br>'+'<div class="post_link">'+'<a href="/posts/'+msg4+'">'+msg3+'による投稿'+'</a>'+'</div>'+'<br>'
                                +'<div class="googlemap_link">'+'<a href="https://www.google.com/maps/search/?api=1&query='+msg1+'">googleマップで詳細検索</a>'+'</div>'
                    }).open(map, marker);    //open(marker.getMap(),marker)
                });
                
                {{--google.maps.event.addListener(marker, 'click', function(event){
                    infowindow.close(map,marker);
                });--}}
            }
            
            initMap();
        </script>
</x-app-layout>