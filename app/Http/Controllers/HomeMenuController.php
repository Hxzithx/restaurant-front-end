<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Http;
// use Illuminate\Support\Facades\Log;

// class HomeMenuController extends Controller
// {
//     public function index()
//     {
//         try{
//            $response = Http::timeout(10)
//            ->withToken(session('api_token'))
//            ->get(env('API_BASE_URL') . 'api/item');

//            $items = [];
//            $groupItem = collect();

//            if($response->successful()){
//               $items = $response->json()['items'] ?? [];

//               //group by category
//                $groupItem = collect($items)->groupBy(function ($item) {
//                return $item['category']['name'] ?? 'Other';
//               });

//               return view('homepages.homepage-2', compact($groupItem));
//            }

//         }catch(\Exception $e){
//            Log::error('Error fetching home menu items.' , [
//               'error' => $e->getMessage(),
//            ]);

//            return view('homepages.homepage-2', [
//                'groupItem' => collect()
//            ]);
//         }
//     }
//}
