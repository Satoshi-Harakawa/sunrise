<head>
    <link rel="stylesheet" href="{{ asset('/css/home_style.css')  }}" >
</head>

<x-app-layout>
    <x-slot name="header">
        投稿検索
    </x-slot>
    
    <div>
        <form action="/search" method="GET">
            @csrf
            <div class="category_search">地域カテゴリ
                <select class="form-control" name="category">
                    <option value="">条件なし</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}地方</option>
                    @endforeach
                </select>
            </div>
            
            <div class="prefecture_search">都道府県を入力
                <input type="text" name="prefecture" value="{{ $prefecture }}">
            </div>
            
            <div class="place_search">地名を入力
                <input type="text" name="keyword" value="{{ $keyword }}">
                <input type="submit" value="検索">
            </div>
        </form>
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

</x-app-layout>