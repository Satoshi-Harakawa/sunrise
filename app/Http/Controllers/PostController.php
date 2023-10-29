<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Cloudinary;

class PostController extends Controller
{
    public function home(Post $post){
        $address_list = array();
        $posts = Post::get();
        foreach ($posts as $post) {
            array_push($address_list, ($post->prefecture).($post->city).($post->after_address));
        }
        return view('posts/home')->with(['posts' => $post->get(),'address_list' => $address_list]);
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
    
    public function edit(Post $post){
        return view('posts/edit')->with(['post' => $post]);
    }
    
    public function update(PostRequest $request, Post $post)
    {
        $input_post = $request['post'];
        $post->fill($input_post)->save();
        return redirect('/posts/' . $post->id);
    }
    
    public function delete(Post $post){
        $post->delete();
        return redirect('/');
    }
}