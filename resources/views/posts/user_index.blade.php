<head>
    <link rel="stylesheet" href="{{ asset('')  }}" >
</head>

<x-app-layout>
    <div class="title-text">
        <p>ユーザー一覧</p>
    </div>
    
    <div class="container">
        @foreach($users as $user)
            <div class="item-row">
                <img src="{{$user->posts->image_url}}" alt="画像読み込めません。" class="item-image"/>
                {{--<div class="text-content">
                    <p class="item-user">{{ $post->user->name }}さんの投稿</p>
                    <a href="/posts/{{ $post->user_id }}/home" class="item-user-link">{{ $post->user->name }}さんの投稿一覧へ</a>
                    <p class="item-title">{{ $post->title }}</p>
                    <a href="/posts/{{ $post->id }}" class="item-title-link">この投稿の詳細へ</a>
                </div>--}}
            </div>
        @endforeach
    </div>
    
</x-app-layout>