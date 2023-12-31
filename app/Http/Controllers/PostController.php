<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Cloudinary;

class PostController extends Controller
{
    public function home(Post $post){
        $address_list = array();
        $place_list = array();
        $user_list = array();
        $post_id_list = array();
        
        $posts = Post::get();
        foreach ($posts as $post) {
            array_push($address_list, ($post->prefecture).($post->city).($post->after_address));
            array_push($place_list, ($post->title));
            array_push($user_list,($post->user->name));
            array_push($post_id_list,($post->id));
        }
        return view('posts/home')->with(['posts' => $post->get(),'address_list' => $address_list,
        'place_list'=> $place_list,'user_list'=>$user_list,'post_id_list'=>$post_id_list]);
    }
    
    public function create(Category $category){
        return view('posts/create')->with(['categories' => $category->get()]);
    }
    
    public function store(Request $request,Post $post){
        
        $input = $request['post'];
        $image_url = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
        $input += ['image_url' => $image_url];
        $input += ['user_id' => $request->user()->id ];
        $post->fill($input)->save();
        return redirect('/');
        
    }
    
    public function show(Post $post){
        $api_key = config('app.api_key');
        return view('posts/show')->with(['post' => $post, 'api_key' => $api_key]);
    }
    
    public function usershow(Post $post){
        $api_key = config('app.api_key');
        return view('users/user_show')->with(['post' => $post, 'api_key' => $api_key]);
    }
    
    public function edit(Post $post,Category $category){
        return view('posts/edit')->with(['post' => $post, 'categories' => $category->get()]);
    }
    
    public function update(PostRequest $request, Post $post)
    {
        $input_post = $request['post'];
        $image_url = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
        $input_post += ['image_url' => $image_url];
        $input_post += ['user_id' => $request->user()->id];
        $post->fill($input_post)->save();
        return redirect('/posts/' . $post->id);
    }
    
    public function delete(Post $post){
        $post->delete();
        return redirect('/');
    }
    
    public function place_map(Request $request,Category $category,Post $post){
        $address_list = array();
        $place_list = array();
        $user_list = array();
        $post_id_list = array();
        
        $category_id = $request->input('category');
        $query = Post::query();
        
        if(!empty($category_id)) {
            $query->where('category_id',"{$category_id}");
        }
        
        $posts = $query->get();
        
        foreach ($posts as $post) {
            array_push($address_list, ($post->prefecture).($post->city).($post->after_address));
            array_push($place_list, ($post->title));
            array_push($user_list,($post->user->name));
            array_push($post_id_list,($post->id));
        }
      
        return view('posts/place_map')->with(['posts' => $posts,'address_list' => $address_list,
        'place_list'=> $place_list,'user_list'=>$user_list,'post_id_list'=>$post_id_list,
        'categories' => $category->get(),'category_id'=>$category_id]);
    }
    
    public function place_search(Request $request,Category $category){
        $category_id = $request->input('category');
        $prefecture = $request->input('prefecture');
        $keyword = $request->input('keyword');
        
        $query = Post::query();
        
        if(!empty($category_id)) {
            $query->where('category_id',"{$category_id}");
        }
        
        if(!empty($prefecture)) {
            $query = $query->where('prefecture','LIKE',"%{$prefecture}%");
        }
        
        if(!empty($keyword)) {
            $query->where('title','LIKE',"%{$keyword}%")
                  ->orWhere('body','LIKE',"%{$keyword}%");
        }
        
        $posts = $query->get();
        return view('posts/place_search')->with(['posts' => $posts,'categories' => $category->get(),
        'keyword' => $keyword,'prefecture' => $prefecture]);
    }
    
}