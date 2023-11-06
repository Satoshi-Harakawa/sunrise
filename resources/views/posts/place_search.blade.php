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
            <div class="search-container">
                <div class="category-search">
                    <p class="category-title">地域カテゴリ</p>
                    <select class="category-select" name="category">
                        <option value="0" selected>選択してください</option>
                        <option value="0">全国</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}地方</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="prefecture-search">
                    <p class-"prefecture-title">都道府県を入力</p>
                    <input type="text" name="prefecture" value="{{ $prefecture }}">
                </div>
                
                <div class="place-search">
                    <p class="place-title">地名・特徴を入力</p>
                    <input type="text" name="keyword" value="{{ $keyword }}">
                </div>
            </div>
            <input type="submit" value="検索">
        </form>
    </div>
    
    <div class="title-text">
        <p>検索結果</p>
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