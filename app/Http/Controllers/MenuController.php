<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MenuController extends Controller
{
    public function index()
    {
        try {
            $response = Http::timeout(10)
                ->withToken(session('api_token'))
                ->get(env('API_BASE_URL') . 'api/menu');

            if ($response->successful()) {
                $items = $response->json()['items'] ?? [];

                //fetch price for each item
                $items = collect($items)->map(function ($item) {
                    $priceResponse = Http::timeout(10)
                    ->withToken(session('api_token'))
                    ->get(env('API_BASE_URL') . 'api/menu/item-prices/' . $item['id']);

                    if($priceResponse->successful()){
                        $item['real_price'] = $priceResponse->json()['item_price']['price'] ?? null;
                    }else {
                        $item['real_price'] = null;
                    }
                    return $item;
                })->toArray();

                $groupedItems = collect($items)->groupBy(function ($item) {
                    return $item['category']['name'];
                });

                return view('other_pages.menu-board', compact('groupedItems'));
            }

            Log::error('Failed to fetch menu items.', [
                'status' => $response->status(),
            ]);

            return view('other_pages.menu-board', [
                'groupedItems' => collect()
            ]);

        } catch (\Exception $e) {
            Log::error('Error fetching menu items.', [
                'error' => $e->getMessage(),
            ]);

            return view('other_pages.menu-board', [
                'groupedItems' => collect()
            ]);
        }
    }

    public function show($id)
    {
    try {
        // Get single item
        $response = Http::timeout(10)
            ->withToken(session('api_token'))
            ->get(env('API_BASE_URL') . 'api/menu/' . $id);

        if (!$response->successful()) {
            return redirect()->route('menu')
                ->withErrors(['error' => 'Item not found.']);
        }

        $item = $response->json()['item'] ?? $response->json();
        
        // Get real price for this item
        $priceResponse = Http::timeout(10)
            ->withToken(session('api_token'))
            ->get(env('API_BASE_URL') . 'api/menu/item-prices/' . $id);

        $item['real_price'] = null;
        if ($priceResponse->successful()) {
            $item['real_price'] = $priceResponse->json()['item_price']['price'] ?? null;
        }

        //get portions
        $portionsResponse = Http::timeout(10)
        ->withToken(session('api_token'))
        ->get(env('API_BASE_URL') . 'api/portions');

        $portions = [];
         if ($portionsResponse->successful()) {
            $portions = $portionsResponse->json()['portions'] ?? [];
         }

         //get addons
         $addOnResponse = Http::timeout(10)
         ->withToken(session('api_token'))
         ->get(env('API_BASE_URL') . 'api/add-ons');

         $addons = [];
         if ($addOnResponse->successful()){
            $addons = $addOnResponse->json()['AddOn'] ?? [];
         }

        // Get all items for related products
        $allResponse = Http::timeout(10)
            ->withToken(session('api_token'))
            ->get(env('API_BASE_URL') . 'api/menu');

        $allItems = $allResponse->json()['items'] ?? [];

        // Related items = same category, exclude current item
        $relatedItems = collect($allItems)
            ->filter(function ($i) use ($item, $id) {
                return $i['id'] != $id &&
                       isset($i['category']['name']) &&
                       $i['category']['name'] === ($item['category']['name'] ?? '');
            })
            ->take(3)
            ->values();

        // Get unique categories for sidebar
        $categories = collect($allItems)
            ->groupBy(fn($i) => $i['category']['name'] ?? 'General')
            ->map(fn($items, $name) => [
                'name'        => $name,
                'items_count' => $items->count(),
            ])
            ->values();

        return view('other_pages.shop-single', compact('item', 'relatedItems', 'categories', 'portions', 'addons'));

    } catch (\Exception $e) {
        Log::error('Error fetching menu item.', [
            'error' => $e->getMessage(),
        ]);

        return redirect()->route('menu')
            ->withErrors(['error' => 'Something went wrong.']);
    }
  }
}