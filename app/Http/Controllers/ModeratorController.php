<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;

class ModeratorController extends Controller
{
    public function dashboard()
    {
        $users = User::where('clearance_level_id', 1)->get();

        $totalUsers = $users->count();
        $totalPosts = Post::count();
        $posts = Post::all();

        return view('moderator.dashboard', compact('users', 'totalUsers', 'totalPosts','posts'));
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        Post::where('user_id', $id)->delete();
        
        $user->delete();

        return redirect()->route('moderator.dashboard')->with('success', 'User deleted successfully.');
    }

    public function deletePost($id){
        $post = Post::findOrFail($id);


        if($post->user->isAdmin()){
            return redirect()->route('moderator.dashboard')->with('error', 'Cannot delete a post created by an admin.');
        }
        
        $post->delete();

        return redirect()->route('moderator.dashboard')->with('success', 'Post deleted successfully.');
    }
}