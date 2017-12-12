<?php

namespace Closet\Http\Controllers;

use Illuminate\Http\Request;
use Closet\Models\Shop;
use Closet\Models\Category;

class ShopController extends Controller
{
    public function index(Shop $shop)
    {
    	$showcases = $shop->showcase()->where('show', true)->orderBy('order', 'asc')->get();
    	$populars = $shop->product()->popular()->get();

    	return view('shop.home', [
    	  'populars' => $populars,
        'showcases' => $showcases,
        'shop' => $shop
      ]);
    }
    public function ajaxStat(Shop $shop)
    {
    	$up = $shop->votes->where('type', '=', 'up')->count();
    	$down = $shop->votes->where('type', '=', 'down')->count();

      	return response()->json([
    		'products' => $shop->productsCount(),
    		'follows' => $shop->followCount(),
    		'up' => $up,
    		'down' => $down
    		], 200);
    }
    public function product(Shop $shop)
    {
        $products = $shop->product()->latestFirst()->get();

        return view('shop.product', [
            'products' => $products,
            'shop' => $shop
            ]);
    }
    public function collection(Shop $shop)
    {
        return view('shop.collection', [
            'shop' => $shop
            ]);
    }
    public function about(Shop $shop)
    {
        return view('shop.about', [
            'shop' => $shop
            ]);
    }

}
