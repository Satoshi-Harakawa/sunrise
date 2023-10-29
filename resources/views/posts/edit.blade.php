<x-app-layout>
    <x-slot name="header">
        編集
    </x-slot>
    <body class="antialiased">
        <h1>投稿</h1>
        <form action="/posts/{{ $post->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="title">
                <h2>地名</h2>
                <input type="text" name="post[title]"  value="{{ $post->title }}" />
            </div>
            
            <div class="Body">
                <h2>本文</h2> 
                <textarea name="post[body]" value="{{ $post->body }}"></textarea>
            </div>
            
            <div class="Place">
                <h2>都道府県</h2>
                <input type="text" id="prefecture" name="post[prefecture]" value="{{ $post->prefecture }}" />
               
                <h2>市区町村</h2>
                <input type="text" id="city" name="post[city]" value="{{ $post->city }}" />
               
                <h2>それ以下の住所</h2>
                <input type="text" id="after_address" name="post[after_address]" value="{{ $post->after_address }}" />
            </div>
            
            <div class="image">
                <input type="file" name="image">
            </div>
            
            <input type="submit" value="保存"/>
        </form>
        
        <div class="footer">
            <a href="/posts/{{ $post->id }}">戻る</a>
        </div>
    </body>
</x-app-layout>