<x-app-layout>
    <x-slot name="header">
        投稿
    </x-slot>
    <form action="/posts" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="title">
            <h2>地名</h2>
            <input type="text" name="post[title]" placeholder="富士山など" value="{{old('post.title')}}" />
        </div>
        
        <div class="body">
            <h2>本文</h2> 
            <textarea name="post[body]" placeholder="感想">{{old('post.body')}}</textarea>
        </div>
        
        <h2>地方選択</h2>
        <div class="category">
            <select class="form-control" name="post[category_id]">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->category_name }}地方</option>
                @endforeach
            </select>
        </div>
        
        <div class="place">
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
        
        <input type="submit" value="投稿"/>
    </form>
    
    <div class="footer">
        <a href="/">戻る</a>
    </div>
</x-app-layout>