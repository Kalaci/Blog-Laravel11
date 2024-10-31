<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboardView() {
        $users = User::all();
        $posts = Post::all();
        $usersCount = User::count();
        $postsCount = Post::count();
        return view('admin.adminDashboard', compact('users', 'posts', 'usersCount', 'postsCount'));
    }

    public function deleteUser($id) {
        $user = User::findOrFail($id);
        
        if ($user->isAdmin()) {
            return redirect()->back()->with('error', 'Admin users cannot be deleted.');
        }

        $user->delete();
        return redirect()->back()->with('success', 'User deleted successfully.');
    }

    public function deletePost($id) {
        $post = Post::findOrFail($id);
        $post->delete();
        
        return redirect()->back()->with('success', 'Post deleted successfully.');
    }

    public function viewAddUser(){
        return view('admin.adminAddUser');
    }

    public function addUser(Request $request) {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'clearance_level_id' => 'required|exists:clearance_levels,id',
        ]);
    
        User::create([
            'name' => $validatedData['title'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']), 
            'clearance_level_id' => $validatedData['clearance_level_id'], // Updated here
        ]);
    
        return redirect()->route('adminDashboard')->with('success', 'User added successfully.');
    }
}
