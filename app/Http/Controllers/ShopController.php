<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ShopController extends Controller
{
    public function shop()
    {
        try{
           $response = Http::withToken(session('api_token'))
           ->get(env('API_BASE_URL') . 'api/menu');

           $items = $response->json()['items'] ?? [];

           //fetch price for each item
           $items = collect($items)->map(function ($item) {
              $priceResponse = Http::withToken(session('api_token'))
              ->get(env('API_BASE_URL'). 'api/menu/item-prices/'. $item['id']);

              if ($priceResponse->successful()){
                 $item['real_price'] = $priceResponse->json()['item_price']['price'] ?? 0;
              } else{
                $item['real_price'] = 0;
              }
              return $item;
           })->toArray();

           return view('other_pages.shop-products', compact('items'));

        }catch (\Exception $e){
           return view('other_pages.shop-products', ['items' => []]);
        }
    }
}
