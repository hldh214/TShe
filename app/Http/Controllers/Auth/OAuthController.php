<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class OAuthController extends Controller
{
    public function redirectToProvider(Request $request, $service)
    {
        return Socialite::driver($service)->redirect();
    }

    public function handleProviderCallback(Request $request, $service)
    {
        $oauth_res = Socialite::driver($service)->user();
        $email     = $oauth_res->getId();

        $user = User::where('email', $email)->first();
        if (is_null($user)) {
            $user           = new User();
            $user->name     = $oauth_res->getNickname();
            $user->avatar   = $oauth_res->getAvatar();
            $user->email    = $email;
            $user->password = bcrypt($email);
            $user->type     = array_search($service, User::type);
            $user->save();
        }

        // I guess you don’t REMEMBER ME, Sherlock, but we grew up together.
        auth()->login($user, true);
        return redirect()->route('home');
    }
}
