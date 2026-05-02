<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller 
{
    public function showLogin()
    {
       if(session('api_token')){
         return redirect()->route('home');
       }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
           'email' => 'required|email',
           'password' => 'required|string|min:8'
        ], [
            'email.required' => 'Email address is required.',
            'email.email'    => 'Please enter a valid email address.',
            'password.required' => 'Password is required',
            'password.min'   => 'Password must be at least 8 characters', 
        ]);

        try{
            //send login request to API
            $response = Http::timeout(10)
            ->post(env('API_BASE_URL') . 'api/user/login', [
                'email'  => $request->email,
                'password' => $request->password,
            ]);

            //handle successfull login
            if($response->successful()) {
                $data = $response->json();

                //store token and user data in session
                session([
                   'api_token'  => $data['token'],
                   'user'       => $data['user'],
                   'user_name'  => $data['user']['first_name'] . '' . $data['user']['last_name'],
                   'user_email' => $data['user']['email'],
                   'user_role'  => $data['user']['role'],
                ]);

                //log successfull login
                Log::info('User logged in successfully.',[
                    'email' => $request->email,
                    'ip'    => $request->ip(),
                ]);

                //redirect based on role
                if($data['user']['role'] === 'admin') {
                    return redirect()->route('home')
                    ->with('success', 'Welcome back,' . $data['user']['first_name'] . '!');
                }
                return redirect()->route('home')
                ->with('success', 'Welcome back,' . $data['user']['first_name'] . '!');
            }

            //handle invalid credentials
            if($response->status() === 401) {
                Log::warning('Failed login attempt.', [
                   'email' => $request->email,
                   'ip'    => $request->ip(),
                ]);
                return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => 'These credentials are do not match our records',
                ]);
            }
            
            //handle other API errors
            return back()
            ->withInput($request->only('email'))
            ->withErrors([
                'email' => 'Something went wrong. Please try again later',
            ]);
        }catch (\Illuminate\Http\Client\ConnectionException $e){
            //api is down
            Log::error('API connection failed during login.' , [
                'error' => $e->getMessage(),
            ]);

            return back()
            ->withInput($request->only('email'))
            ->withErrors([
                 'email' => 'Unable to connect to the server. Please try again later',
            ]);
        }catch (\Exception $e){
            Log::error('Unexpected error during login.', [
                'error' => $e->getMessage(), 
            ]);

            return back()
            ->withInput($request->only('email'))
            ->withErrors([
                'email' => 'An unexpected error occured. Please try again',
            ]);
        }
    }

    public function logout(Request $request)
    {
        try{
           //inform API to invalid content
           Http::withToken(session('api_token'))
           ->post(env('API_BASE_URL') . '/api/logout');
        }catch (\Exception $e){
           Log::error('Error during logout.' ,[
              'error' => $e->getMessage(),
           ]);
        }

        //log the logout
        Log::info('User logged out.', [
            'email' => session('user_email'),
            'ip'    => $request->ip(),
        ]);

        //clear the session data
        $request->session()->flush();

        return redirect()->route('login')
        ->with('success', 'You have been logged out successfully.');
    }
}