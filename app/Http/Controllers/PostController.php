<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Validation\Rules\Exists;

class PostController extends Controller
{
     public function index(){
        $posts = Post::latest()->get();
       
        return view('dashboard', compact('posts'));

     }

     public function add(Request $request){


        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required',
            'thumbnail' => 'mimes:jpg,png,jpeg',
        ],
        [
            'title.required' =>"Please enter a title", 
            'body.required' =>"Please enter blog content",   
        ]);

        if($request->thumbnail){
        $newImageName =  time() . '-' . $request->title . ".". $request->thumbnail->extension();
        $request->thumbnail->move(public_path('images'), $newImageName);

        Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'date_published' => Carbon::now(),
            'user_id' => Auth::id(),
            'thumbnail' => $newImageName,
        ]);
        }else{

        Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'date_published' => Carbon::now(),
            'user_id' => Auth::id(),
            'thumbnail' => null,
        ]);
        }

        return redirect()->route('dashboard')->with('success', 'Post created successfully.');
     }

     public function createView()
    {
        return view('posts.create');
    }

    public function userPosts(){
        $user = Auth::user();

        $posts =Post::where('user_id', $user->id)->latest()->get();
        return view('posts.userPosts', compact('posts'));
    }

    public function showPost(Post $post){
        return view ('posts.showPost', compact('post'));
    }

    public function deletePost($id)
    {
        $post = Post::find($id);
    
        if (!$post) {
            return redirect()->route('userPosts')->with('error', 'Post not found');
        }
    
        if ($post->thumbnail) {
            $thumbnailPath = public_path('images/' . $post->thumbnail);
            if (file_exists($thumbnailPath)){
                unlink($thumbnailPath);
            }
        }
    
        $post->delete();
    
        return redirect()->route('userPosts')->with('success', 'Post deleted');
    }
    
    public function editPost($id){
        $post = Post::find($id);
        return view('posts.create', compact('post'));
    }

    public function updatePost(Request $request, $id){
        
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required',
            'thumbnail' => 'mimes:jpg,png,jpeg',
        ],
        [
            'title.required' =>"Please enter a title", 
            'body.required' =>"Please enter blog content",   
        ]);

        $post = Post::find($id);

        if($request->thumbnail){
            $newImageName =  time() . '-' . $request->title . ".". $request->thumbnail->extension();
            $request->thumbnail->move(public_path('images'), $newImageName);
    
            $post->update([
                'title' => $request->title,
                'body' => $request->body,
                'date_published' => Carbon::now(),
                'user_id' => Auth::id(),
                'thumbnail' => $newImageName,
            ]);
        }else{
            $image = $post->thumbnail;
            $post->update([
                'title' => $request->title,
                'body' => $request->body,
                'date_published' => Carbon::now(),
                'user_id' => Auth::id(),
                'thumbnail' => $image,
            ]);
        }
        return redirect()->route('userPosts')->with('success', "Post updated");
    }
}

