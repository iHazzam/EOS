<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use App\Currency;

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


 }
//}
