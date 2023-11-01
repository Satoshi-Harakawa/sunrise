<x-app-layout>
    <x-slot name="header">
        投稿
    </x-slot>
    <body class="antialiased">
        <form action="/posts" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="title">
                <h2>地名</h2>
                <input type="text" name="post[title]" placeholder="タイトル" value="{{old('post.title')}}" />
            </div>
            
            <div class="Body">
                <h2>本文</h2> 
                <textarea name="post[body]" placeholder="今日も１日お疲れ様でした。">{{old('post.body')}}</textarea>
            </div>
            
            <div class="Place">
                <h2>都道府県</h2>
                <input type="text" id="prefecture" name="post[prefecture]" placeholder=",〇〇県など" value="" />
               
                <h2>市区町村</h2>
                <input type="text" id="city" name="post[city]" placeholder="〇〇市〇〇町など" value="" />
               
                <h2>それ以下の住所</h2>
                <input type="text" id="after_address" name="post[after_address]" placeholder="〇-〇-〇など" value="" />
            </div>
            
            <div class="image">
                <input type="file" name="image">
            </div>
            
            <input type="submit" value="store"/>
        </form>
        
        <div class="footer">
            <a href="/">戻る</a>
        </div>
    </body>
</x-app-layout>