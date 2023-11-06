<head>
    <link rel="stylesheet" href="{{ asset('/css/home_style.css')  }}" >
</head>

<x-app-layout>
    <x-slot name="header">
        地域別マップ
    </x-slot>
    <div class="title-text">
        <p>地域別の投稿が<span class="span-marker">マーカー</span>として表示されています！</p>
        <p><span class="span-marker">マーカー</span>をクリックすると詳細が見られます！</p>
    </div>
        
    <div>
        <form action="/map" method="GET">
            @csrf
            <div class="category_search">地域カテゴリ
                <select class="form-control" name="category" onchange="submit(this.form)">
                    <option value="0" selected>選択してください</option>
                    <option value="0">全国</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}地方</option>
                    @endforeach
                </select>
            </div>
            
        </form>
    </div>
    <?php
        $height = "1250px";
        if($category_id != null){
            switch($category_id){
                case 1:
                    $height = "600px";
                    break;
                case 2:
                    $height = "600px";
                    break;
                case 3:
                    $height = "600px";
                    break;
                case 4:
                    $height = "950px";
                    break;
                case 5:
                    $height = "600px";
                    break;
                case 6:
                    $height = "700px";
                    break;
                case 7:
                    $height = "700px";
                    break;
            }
        }
    ?>
    <div class="googlemap">
        <div id="map" style="height:{{$height}};" ></div>
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
        const position = [
            {lat: 36.67872, lng: 139.01732 },//全国
            {lat: 43.54245, lng: 142.61078 },//北海道
            {lat: 39.22273, lng: 140.62641 },//東北
            {lat: 35.89281, lng: 139.54392 },//関東
            {lat: 36.51402, lng: 138.07184 },//中部
            {lat: 34.61287, lng: 135.66127 },//近畿
            {lat: 34.23611, lng: 132.93584 },//中国・四国
            {lat: 32.58636, lng: 130.70927 },//九州
        ];
        
        const zoom = [6,7,7,8,8,8,8,8];
        
        let markerData = @json($address_list);
        let placeData = @json($place_list);
        let userData = @json($user_list);
        let postIdData = @json($post_id_list);
        let categoryId = @json($category_id);
        
        
        function initMap(){
            map = new google.maps.Map(document.getElementById('map'),{
                center: position[categoryId],
                zoom: zoom[categoryId] // 地図のズームを指定
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