<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Image;

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
    public function update(ProfileUpdateRequest $request)//: RedirectResponse
    {

        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
       Auth::user()->briefInfo=$request->briefInfo;

       if ($request->file('profileImage')){
        $file = $request->file('profileImage');
        $fileName =date('YmdHi').$file->getClientOriginalName();
        Image::make($request->file('profileImage'))->resize(1200,1200)->save(('profileImages/').$fileName);
        Auth::user()->profileImage=$fileName;
  }
  else{Auth::user()->profileImage="defultprofileImage";}
        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    public function deleteProfileImage(){

       $user= User::find(Auth::user()->id);
       $user->profileImage='';
       $user->save();
        return  redirect()->back();
    }
}



