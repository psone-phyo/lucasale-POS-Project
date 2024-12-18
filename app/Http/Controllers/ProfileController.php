<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ActionLog;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

use function PHPUnit\Framework\fileExists;
use App\Http\Requests\ProfileUpdateRequest;

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
        if(Auth::user()->role == 'user'){

            return view('user.profile');
        }
        return view('admin.profile.profile');
    }

    //show profile update page
    public function profileeditform(){
        if(Auth::user()->role == 'user'){
            return view('user.profileedit');
        }
        return view('admin.profile.profileedit');
    }

    //updates the profile data
    public function profileedit(Request $request){
        $this->profilevalidation($request);

        if($request->file('profile')){
            if (Auth::user()->profile != null){
                if(Auth::user()->role == 'user'){
                    if (file_exists(public_path('user/img/'. Auth::user()->profile))){
                        unlink(public_path('user/img/'. Auth::user()->profile));
                    }
                }else{
                    if (file_exists(public_path('admin/img/'. Auth::user()->profile))){
                        unlink(public_path('admin/img/'. Auth::user()->profile));
                    }
                }

            }
            $filename = uniqid() . $request->file('profile')->getClientOriginalName();
            if(Auth::user()->role == 'user'){
                $request->file('profile')->move(public_path('user/img'), $filename);
            }else{
                $request->file('profile')->move(public_path('admin/img'), $filename);
            }
        }else{
            $filename = Auth::user()->profile?? null;
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
        if(Auth::user()->role == 'user'){
            ActionLog::create([
                'user_id' => Auth::user()->id,
                'product_id' => 0,
                'action' => 'profile updated',
            ]);
            return to_route('user#profile');
        }
        return to_route('profile');
    }

    //show change password page
    public function changePassword(){
        if(Auth::user()->role == 'user'){
            return view('user.changepassword');
        }
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
            if(Auth::user()->role == 'user'){
                ActionLog::create([
                    'user_id' => Auth::user()->id,
                    'product_id' => 0,
                    'action' => 'password changed',
                ]);
                return to_route('user#profile');

            }
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
