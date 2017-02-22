<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class PagesController extends Controller
{
  //  public function welcome()
  //  {
//        //dd(phpinfo());
//        dd(DB::connection('sqlsrv')->table('dbo.vw_PhilsExportOrderForm')->first());
//        if(DB::connection('sqlsrv')->get)
//        {
//            $db2 = DB::connection('sqlsrv');
//            $currencies = $db2->table('SYSCurrency')->get();
//            dd($currencies);
//        }
//        else{
//            dd('not connected');
     //   }
        //return view('welcome');
 //   }

    public function welcome()
    {
        return view('welcome');
    }
    public function showDashboard()
    {
        return view('dashboard');
    }
    
    public function getUserSettings()
    {
        return view('settings');
    }
    public function postUserSettings(Request $request)
    {

    }

}