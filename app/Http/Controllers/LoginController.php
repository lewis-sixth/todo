<?php

namespace App\Http\Controllers;

use App\User;
use Socialite;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $user = $this->getOrCreateUser(Socialite::driver('google')->user());

        Auth::login($user, true);

        return redirect()->route('dashboard');
    }

    protected function getOrCreateUser($user)
    {
        $existingUser = User::where('email', $user->email)->first();

        if ($existingUser) {
            return $existingUser;
        }

        return User::create([
            'name' => $user->name,
            'email' => $user->email,
            'avatar' => $user->avatar
        ]);
    }
}
