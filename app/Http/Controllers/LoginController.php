<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{

    public function redirect($provider) {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider){
            $user = Socialite::driver($provider)->user();
            $user = User::updateOrCreate([
                'provider_id' => $user->id,
            ], [
                'name' => $user->name,
                'nickname' => $user->nickname,
                'email' => $user->email,
                'profile' => $user->avatar,
                'provider' => $provider,
                'provider_token' => $user->token,
                'provider_refresh_token' => $user->refreshToken,
            ]);

            Auth::login($user);

            return to_route('home');
    }


}
