<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\CustomerRecord;
use App\Models\ExternalIdentity;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Auth\Events\Registered;

class SocialiteController extends Controller
{
    public function redirect(Request $request)
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect('/login')->withErrors(['email' => 'Google authentication failed.']);
        }

        $identity = ExternalIdentity::where('provider', 'google')
            ->where('provider_user_id', $googleUser->getId())
            ->first();

        // If user is already logged in, we link the account
        if (Auth::check()) {
            if (!$identity) {
                ExternalIdentity::create([
                    'user_id' => Auth::id(),
                    'provider' => 'google',
                    'provider_user_id' => $googleUser->getId(),
                ]);
            }
            return redirect()->route('home')->with('status', 'Google account linked successfully.');
        }

        // Not logged in. Check if external identity exists.
        if ($identity) {
            Auth::login($identity->user);
            $request->session()->regenerate();
            return redirect()->intended(route('home', absolute: false));
        }

        // Check if an email match exists in Traventure
        $existingUser = User::where('email', $googleUser->getEmail())->first();

        if ($existingUser) {
            // Do not silently merge. Require password login first.
            return redirect('/login')->withErrors(['email' => 'An account with this email already exists. Please sign in with your password and then link your Google account from your profile.']);
        }

        // New user
        $user = DB::transaction(function () use ($googleUser) {
            $emailVerifiedAt = null;
            if (isset($googleUser->user['email_verified']) && $googleUser->user['email_verified']) {
                $emailVerifiedAt = now();
            }

            $newUser = User::create([
                'name' => $googleUser->getName() ?? 'Google User',
                'email' => $googleUser->getEmail(),
                'password' => null,
                'role' => 'Customer',
            ]);

            if ($emailVerifiedAt) {
                $newUser->email_verified_at = $emailVerifiedAt;
                $newUser->save();
            }

            CustomerRecord::create([
                'user_id' => $newUser->id,
                'name' => $newUser->name,
            ]);

            ExternalIdentity::create([
                'user_id' => $newUser->id,
                'provider' => 'google',
                'provider_user_id' => $googleUser->getId(),
            ]);

            return $newUser;
        });

        if (!$user->hasVerifiedEmail()) {
            event(new Registered($user));
        }

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->intended(route('home', absolute: false));
    }
}
