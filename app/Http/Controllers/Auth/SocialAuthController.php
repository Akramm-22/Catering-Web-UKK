<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function redirect($provider)
    {
        if (!in_array($provider, ['google', 'facebook'])) {
            abort(404);
        }
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        if (!in_array($provider, ['google', 'facebook'])) {
            abort(404);
        }

        try {
            $socialUser = Socialite::driver($provider)->user();

            // Cek apakah email sudah ada
            $existingUser = User::where('email', $socialUser->getEmail())->first();

            if ($existingUser) {
                // Update info social tapi jangan ubah is_admin
                $existingUser->update([
                    'avatar'          => $socialUser->getAvatar() ?? $existingUser->avatar,
                    'provider'        => $provider,
                    $provider.'_id'   => $socialUser->getId(),
                ]);
                $user = $existingUser;
            } else {
                // Buat user baru — semua user baru via social = bukan admin
                $user = User::create([
                    'name'              => $socialUser->getName() ?? $socialUser->getNickname() ?? explode('@', $socialUser->getEmail())[0],
                    'email'             => $socialUser->getEmail(),
                    'avatar'            => $socialUser->getAvatar(),
                    'provider'          => $provider,
                    $provider.'_id'     => $socialUser->getId(),
                    'password'          => bcrypt(Str::random(32)),
                    'email_verified_at' => now(),
                    'is_admin'          => false,
                ]);
            }

            Auth::login($user, true);

            if ($user->isAdmin()) {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('home');

        } catch (\Exception $e) {
            return redirect()->route('login')
                ->with('error', 'Login dengan ' . ucfirst($provider) . ' gagal: ' . $e->getMessage());
        }
    }
}
