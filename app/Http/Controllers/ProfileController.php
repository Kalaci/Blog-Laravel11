<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->validated());        

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        if($request->hasFile('profile_avatar')){
            $newImageName =  time() . '-' . $request->file('profile_avatar')->getClientOriginalName();
            $request->file('profile_avatar')->move(public_path('images'), $newImageName);
            $user->profile_picture = $newImageName;
        }
        // dd($request);

        $user->location = $request->location;
        $user->description = $request->description;

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function profileView($id){
        $user = User::with('posts')->findOrFail($id); 
        return view('profile.user-view', compact('user'));
    }
}
