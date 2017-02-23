<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
class apiController extends Controller
{
    //
    public function getProducts()
    {
        if (Cache::has('products')) {
            return Cache::get('products');
        }
        else{
            return "peanuts";
        }
    }


 }
//}
