<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'phone'      => 'required',
            'address'    => 'required|string|max:500',
            'email'      => 'required|email',
            'password'   => 'required|string|min:8|confirmed',
        ], [
            'first_name.required' => 'First name is required.',
            'last_name.required'  => 'Last name is required.',
            'phone.required'      => 'Phone number is required.',
            'address.required'    => 'Address is required.',
            'email.required'      => 'Email address is required.',
            'email.email'         => 'Please enter a valid email address.',
            'password.required'   => 'Password is required.',
            'password.min'        => 'Password must be at least 8 characters.',
            'password.confirmed'  => 'Passwords do not match.',
        ]);

        try {
            $response = Http::timeout(10)
                ->post(env('API_BASE_URL') . '/api/user/register', [
                    'first_name'            => $request->first_name,
                    'last_name'             => $request->last_name, 
                    'phone'                 => $request->phone,
                    'address'               => $request->address,
                    'email'                 => $request->email,
                    'role'                  => 'user',
                    'password'              => $request->password,
                    'password_confirmation' => $request->password_confirmation,
                ]);

            if ($response->successful()) {
                Log::info('New user registered.', [
                    'email' => $request->email,
                    'ip'    => $request->ip(),
                ]);

                return redirect()->route('login')
                    ->with('success', 'Account created! Please sign in.');
            }

            
            // Show API validation errors if any
            $errors = $response->json()['errors'] ?? null;

            if ($errors) {
                return back()->withInput()->withErrors($errors);
            }

            return back()->withInput()->withErrors([
                'email' => 'Registration failed. Please try again.',
            ]);

        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('API connection failed during registration.', [
                'error' => $e->getMessage(),
            ]);

            return back()->withInput()->withErrors([
                'email' => 'Unable to connect to the server. Please try again later.',
            ]);

        } catch (\Exception $e) {
            Log::error('Unexpected error during registration.', [
                'error' => $e->getMessage(),
            ]);

            return back()->withInput()->withErrors([
                'email' => 'An unexpected error occurred. Please try again.',
            ]);
        }
    }
}