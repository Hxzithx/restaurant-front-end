<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    public function index()
    {
        try{

        $response = Http::withToken(session('api_token'))
        ->get(env('API_BASE_URL') . 'api/customer/profile');

        $profileData = [];
        if($response->successful()) {
            $profileData = $response->json()['customer'] ?? $response->json();
        }

        return view('profile.index', compact('profileData'));
        }catch (\Exception $e){
           return view('profile.index', ['profileData' =>[]]);  
       }
    }

    public function update(Request $request)
    {
        
        try {

            $request->validate([
                'name'    => 'sometimes|string|max:255',
                'phone'   => 'sometimes|string|max:20',
                'address' => 'sometimes|string|max:255',
                'avatar'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
            ]);

            //split full name into first + last names 
            $fullName = trim($request->name);
            $nameParts = explode(' ', $fullName, 2);

            $firstName = $nameParts[0] ?? '';
            $lastName = $nameParts[1] ?? '';

            $http = Http::timeout(10)
                ->withToken(session('api_token'));

                //attach file if exist
                if($request->hasFile('avatar')) {
                    $http = $http->attach(
                      'avatar',
                      file_get_contents($request->file('avatar')->getRealPath()),
                      $request->file('avatar')->getClientOriginalName()
                    );
                }
                $response = $http->post(env('API_BASE_URL').'api/customer/profile', [
                    '_method'     => 'PUT', 
                    'first_name'  => $firstName,
                    'last_name'   => $lastName,
                    'phone'       => $request->phone,
                    'address'     => $request->address,
                ]);

            if ($response->successful()) {
                $user = $response->json()['customer'];

                $safeName = trim(
                   ($user['first_name'] ?? '') . ' ' .
                   ($user['last_name'] ?? '')
                );

                if($safeName === '') {
                    $safeName = $user['name'] ?? session('user_name');
                }
                // Update session
                session([
                    'user_name'    => $safeName,
                    'user_email'   => $user['email'],
                    'user_avatar'  => $user['avatar'],
                    'user_phone'   => $user['phone'],
                    'user_address' => $user['address'],
                ]);

                return response()->json([
                    'message'  => 'Profile updated successfully',
                    'customer' => $user,
                ],200);
            }

            return response()->json([
                'message' => $response->json()['message'] ?? 'Update failed',
                'errors'  => $response->json()['errors'] ?? [],
            ], $response->status());

        } catch (\Exception $e) {
            Log::error('Profile update error', ['error' => $e->getMessage()]);

            return response()->json([
                'message' => 'Something went wrong.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function checkProfile()
    {
        $response = Http::withToken(session('api_token'))
       ->get(env('API_BASE_URL').'api/customer/profile');

           $user = $response->json()['customer'];

           return response()->json([
             'name'    => trim(($user['first_name'] ?? '') . ' ' . ($user['last_name'] ?? '')),
             'phone' => $user['phone'],
             'address' => $user['address']
]);
    }
}