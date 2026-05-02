<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirect()
    {
        //clear previous session
        session()->flush();
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Send google user data to API
            $response = Http::timeout(10)
                ->post(env('API_BASE_URL') . 'api/auth/google', [
                    'google_id' => $googleUser->getId(),
                    'name'      => $googleUser->getName(),
                    'email'     => $googleUser->getEmail(),
                    'avatar'    => $googleUser->getAvatar(),
                ]);

            if ($response->successful()) {
                $data = $response->json();

                session([
                    'api_token'  => $data['token'],
                    'user'       => $data['user'],
                    'user_name'  => $data['user']['first_name'] . ' ' . $data['user']['last_name'],
                    'user_email' => $data['user']['email'],
                    'user_role'  => $data['user']['role'],
                    'user_avatar' => $data['user']['avatar'] ?? null,
                ]);

                Log::info('Google login successful.', [
                    'email' => $googleUser->getEmail(),
                ]);

                return redirect()->route('home');
            }

            Log::error('Google login API failed.', [
                'status'   => $response->status(),
                'response' => $response->json(),
            ]);

            return redirect()->route('login')
                ->withErrors(['email' => 'Google login failed. Please try again.']);

        } catch (\Exception $e) {
            Log::error('Google login error.', [
                'error' => $e->getMessage(),
            ]);

            return redirect()->route('login')
                ->withErrors(['email' => 'Google login failed. Please try again.']);
        }
    }
}