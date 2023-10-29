<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <link rel="stylesheet" href="{{ asset('/css/try.css')  }}" >
    </head>
    <div class="container">
    @foreach ($posts as $post)
        <div class="item-row">
            <img src="{{ $post->image_url }}" alt="画像が読み込めません" class="item-image">
            <div class="text-content">
                <h2 class="item-title">{{ $post->title }}</h2>
                <p class="item-text">{{ $post->body }}</p>
            </div>
        </div>
    @endforeach
</div>
    <a href="/">戻る</a>
</html>