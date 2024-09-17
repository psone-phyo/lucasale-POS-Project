<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

use function PHPUnit\Framework\fileExists;

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
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

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

    //show profile page
    public function profile(){
        return view('admin.profile.profile');
    }

    //show profile update page
    public function profileeditform(){
        return view('admin.profile.profileedit');
    }

    //updates the profile data
    public function profileedit(Request $request){
        $this->profilevalidation($request);

        if($request->file('profile')){
            if (Auth::user()->profile != null){
                if (file_exists(public_path('admin/img/'. Auth::user()->profile))){
                    unlink(public_path('admin/img/'. Auth::user()->profile));
                }
            }
            $filename = uniqid() . $request->file('profile')->getClientOriginalName();
            $request->file('profile')->move(public_path('admin/img'), $filename);
        }else{
            $filename = Auth::user()->profile?? 'undraw_profile_1.svg';
        }
        $data = [
            'username' => $request->username,
            'email'=> $request->email,
            'nickname' => $request->nickname??null,
            'address' => $request->address??null,
            'phone' => $request->phone??null,
            'profile' => $filename,
        ];
        User::find(Auth::user()->id)->update($data);
        return to_route('profile');
    }

    //show change password page
    public function changePassword(){
        return view('admin.profile.passwordchange');
    }

    //updates changed password
    public function updatepassword(Request $request){
        $request->validate([
            'oldpassword' => 'required',
            'newpassword' => 'required',
            'newpasswordconfirmation' => 'required|min:8|max:12|same:newpassword',
        ]);
        if (Hash::check($request->oldpassword,Auth::user()->password)){
            $data= [
                'password' => Hash::make($request->newpassword)
            ];
            User::find(Auth::user()->id)->update($data);
            return to_route('profile');
        }else{
            return back()->with('wrongpassword', 'Incorrect current password');
        }
    }

    //show create admin page
    public function createadmin(){
        return view('admin.profile.createadmin');
    }

    //show admin list page
    public function adminlist(){
        $data = User::select('id', 'name', 'nickname', 'email', 'phone', 'address', 'role', 'created_at')
                        ->whereIn('role', ['admin', 'superadmin'])
                        ->whereany(['id', 'name', 'nickname', 'email', 'phone', 'address', 'role', 'created_at'], 'like', '%'.request('searchKey').'%')
                        ->paginate(5);
        return view('admin.profile.adminlist', compact('data'));
    }

    //show user list page
    public function userlist(){
        $data = User::select('id', 'name', 'nickname', 'email', 'phone', 'address', 'role', 'created_at', 'provider')
                        ->whereIn('role', ['user'])
                        ->whereany(['id', 'name', 'nickname', 'email', 'phone', 'address', 'role', 'created_at', 'provider'], 'like', '%'.request('searchKey').'%')
                        ->paginate(5);
        return view('admin.profile.userlist', compact('data'));
    }

    //adminlist and userlist delete
    public function listdelete($id){
        User::find($id)->delete();
        return back();
    }

    //validation of profile data
    private function profilevalidation($request){
        $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'email' => 'required|string|lowercase|email|max:255',
            'phone' => 'nullable|numeric',
            'image' => 'memes:jpg,jpeg,png,svg'
        ]);
    }

}
