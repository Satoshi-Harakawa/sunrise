<head>
    <link rel="stylesheet" href="{{ asset('/css/home_style.css')  }}" >
</head>

<x-app-layout>
    <x-slot name="header">
        全国マップ
    </x-slot>
        <div class="title-text">
            <p>日本全国の絶景投稿ブログです！</p>
            <p>全ての投稿が<span class="span-marker">マーカー</span>として表示されています！</p>
            <p><span class="span-marker">マーカー</span>をクリックすると詳細が見られます！</p>
            <p>投稿したい場合は、すぐ下の<span class="span-btn">投稿ボタン</span>から！</p>
        </div>
    
        <div class="btn">
            <a href="/create">投稿</a>
        </div>
        
        <div class="googlemap">
            <div id="map"></div>
        </div>
        
        <div class="title-text">
            <p>投稿一覧</p>
        </div>    
            
        <div class="container">
            @foreach($posts as $post)
                <div class="item-row">
                    <img src="{{ $post->image_url }}" alt="画像が読み込めません。" class="item-image"/>
                    <div class="text-content">
                        <p class="item-user">{{ $post->user->name }}さんの投稿</p>
                        <a href="/posts/{{ $post->user_id }}/home" class="item-user-link">{{ $post->user->name }}さんの投稿一覧へ</a>
                        <p class="item-title">{{ $post->title }}</p>
                        <a href="/posts/{{ $post->id }}" class="item-title-link">この投稿の詳細へ</a>
                    </div>
                </div>
            @endforeach
        </div>
        
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPD2t5vZx1y4Qq71BZOjSAhsPwugj2d8Q"></script>
        <script>
            let map;
            let marker;
            const position = {
                lat: 36.67872, // 緯度
                lng: 139.01732 // 経度
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
                        content: '地名：'+msg1+'<br>'+'住所：'+msg2+'<br>'+'<div class="post_link">'+'<a href="/posts/'+msg4+'">'+msg3+'さんによる投稿を見る'+'</a>'+'</div>'+'<br>'
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