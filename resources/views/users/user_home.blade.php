<head>
    <link rel="stylesheet" href="{{ asset('/css/home_style.css')  }}" >
</head>

<x-app-layout>
    
    <div class="title-text">
        <p>マイページ（投稿一覧）</p>
    </div>
    
    <div class="container">
        @foreach($posts as $post)
            <div class="item-row">
                <img src="{{ $post->image_url }}" alt="画像が読み込めません。" class="item-image" />
                <div class="text-content">
                    <p class="item-title">{{ $post->title }}</p>
                    <a href="/userposts/{{ $post->id }}" class="item-title-link">投稿確認・編集・削除</a>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>