<head>
    <link rel="stylesheet" href="{{ asset('/css/create_style.css')  }}" >
</head>

<x-app-layout>
    <div class="title-text">
        <p>投稿フォーム</p>
    </div>
    
    <div class="form-container">
        <form action="/posts" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="title">
                <h2>地名</h2>
                <input type="text" name="post[title]" class="title-input" placeholder="＜例＞川口湖からみた富士山" value="{{old('post.title')}}" />
            </div>
            
            <div class="body">
                <h2>本文</h2> 
                <textarea name="post[body]"  class="body-textarea" placeholder="＜例＞富士山がとてもきれいでした！">{{old('post.body')}}</textarea>
            </div>
            
            <div class="image">
                <p>写真</p>
                <input type="file" name="image" class="image-input">
            </div>
            
            <div class="category">
                <p>撮影した場所の情報</p>
                <h2>地方選択</h2>
                <select class="form-control" name="post[category_id]">
                    <option value="0" selected>選択してください</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}地方</option>
                    @endforeach
                </select>
            </div>
            
            <div class="prefecture">
                <h2>都道府県</h2>
                <input type="text" id="prefecture" name="post[prefecture]" class="prefecture-input" placeholder="＜例＞山梨県" value="" />
            </div>
            <div class="city">
                <h2>市区町村</h2>
                <input type="text" id="city" name="post[city]" class="city-input" placeholder="＜例＞富士河口湖町" value="" />
            </div>
            <div class="after-address">
                <h2>それ以下の住所</h2>
                <input type="text" id="after_address" name="post[after_address]" class="after-address-input" placeholder="＜例＞1-1-1" value="" />
            </div>
         
            <p class="formbottom">
                <input type="submit" value="投稿" class="btns submit"/>
            </p>
        </form>
    </div>
    
    <div class="footer">
        <a href="/" class="btn2">戻る</a>
    </div>
</x-app-layout>