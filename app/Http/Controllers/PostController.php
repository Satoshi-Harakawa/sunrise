<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Cloudinary;

class PostController extends Controller
{
    public function home(Post $post){
        return view('posts/home')->with(['posts' => $post->get()]);
    }
    
    public function create(){
        return view('posts/create');
    }
    
    public function store(Request $request,Post $post){
        
        $input = $request['post'];
        $image_url = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
        $input += ['image_url' => $image_url];  
        $post->fill($input)->save();
        return redirect('/');
        
    }
    
    public function show(Post $post){
        $api_key = config('app.api_key');
        return view('posts/show')->with(['post' => $post, 'api_key' => $api_key]);
    }
}
