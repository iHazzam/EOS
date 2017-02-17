<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{
    //
    public function showForm()
    {
        //show the order form

        return view('order.form');
    }
    public function postForm(Request $request)
    {
        //failure
        $foobar = null;//temp
        if($foobar == false)//temp
        {
            return redirect()->back()->withInput();
        }

        //success

        return redirect('orders.postorder');
    }
}
