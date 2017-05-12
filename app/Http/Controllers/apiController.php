<?php

namespace App\Http\Controllers;

use App\User;
use App\Order;
use App\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use App\Currency;
use Monolog\Logger;
use Illuminate\Support\Facades\Log;
class apiController extends Controller
{
    //
    public function getProducts()
    {
        if (Cache::has('products')) {
            return Cache::get('products');
        }
        else{
            return array('Code'=>503,'Message'=>'Cache Incomplete');
        }
    }
    public function getCurrencies()
    {
        $currencies = Currency::all();
        $larry = array();
        foreach($currencies as $currency)
        {
            $larry[$currency->name] = $currency->modifier;
        }
        return $larry;
    }

    public function newOrder(Request $request)
    {
        Log::info('Request made');
        dd($request);
    }

    public function auth()
    {
        Log::info('Auth called');
        return 'true';
    }
    public function userDetails($id)
    {
        //TODO: Add fbmid column to user table in DB
        return User::where('fbmid','=',$id)->first();
    }
    public function getLastOrder($id)
    {
        $user = User::where('fbmid','=',$id)->first();
        return Order::where('user_id','=',$user->id)->latest()->first();
    }
    public function getLastOrderItems(Order $oid)
    {
        $products = OrderProduct::where('order_id','=',$oid->id)->get();
        return $products;
    }

 }