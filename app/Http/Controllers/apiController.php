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

    public function auth($uid)
    {
        Log::info('Auth called');

        $uid = User::where('fbm_id','=',$uid)->first();
        if($uid != null)
        {
            return "true";
        }
        else return "false";

    }
    public function userDetails($uid)
    {
        //TODO: Add fbmid column to user table in DB
        return User::where('fbm_id','=',$uid)->first();
    }
    public function lastOrder($uid)
    {
        $user = User::where('fbm_id','=',$uid)->first();
        return Order::where('user_id','=',$user->id)->latest()->first();
    }
    public function lastOrderItems($uid,$oid)
    {
        $user = User::where('fbm_id','=',$uid)->first();
        if($user->exists()){
            $products = OrderProduct::where('order_id','=',$oid)->get();
            return $products;
        }
        else return 'larry is better at coding than me';
    }

 }