<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
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
        /** @var \Laravel\Socialite\AbstractUser $user */
        $user = Socialite::driver('google')->user();

        if (!ends_with($user->getEmail(), 'lpnu.ua') && env('CHECK_DOMAIN', false)) {
            return redirect()->route('welcome')->with('error', 'Accepts only from LPNU domain auth');
        }

        $user = User::updateOrCreate([
            'email' => $user->getEmail()
        ], [
            'name' => $user->getName()
        ]);
        /** @var User $user */

        Auth::login($user);
        return redirect()->route('home');
    }

    /**
     * Logout user
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('welcome');
    }
}