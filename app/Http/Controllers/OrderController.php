<?php

namespace App\Http\Controllers;

use App\Notifications\OrderPlaced;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Order;
use App\OrderProduct;
use ErrorException;
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
      try
      {
          $this->validate($request,[
              'addr1' => 'required',
              'city' => 'required',
              'postcode' => 'required',
              'name_on_order' => 'required',
              'email' => 'required',
              'contact_phone' => 'required',
              'project_name'=>'required',
              'country'=>'required',
              'purchase_order_reference'=>'required',
              'delivery' => 'required',
              'order_total' => 'required'
          ]);
          $error = false;
          $order = new Order();

          $order->address_line1 = $request->addr1;
          $order->city = $request->city;
          $order->contact_name = $request->name_on_order;
          $order->postcode = $request->postcode;
          $order->country = $request->country;
          $order->email = $request->email;
          $order->phone = $request->contact_phone;
          $order->project_name = $request->project_name;
          $order->purchase_order_reference = $request->purchase_order_reference;
          $order->delivery = $request->delivery;
          $order->order_total = $request->order_total;


          if($request->has('addr2'))
          {
              $order->address_line2 = $request->addr2;
          }
          if($request->has('datepicker'))
          {
              $order->delivery_date = date("y-m-d", strtotime($request->datepicker));
          }
          $order->shipping_total = ($order->order_total * (Auth::user()->shipping_percent/100))+ Auth::user()->shipping_flat;
          if($request->has('incoterms'))
          {
              $order->incoterms = $request->incoterms;
          }
          if($request->has('custom'))
          {
              $order->custom = $request->custom;
          }
          $order->user_id = Auth::user()->id;
          $oid = $order->save();
          foreach($request->products as $key => $prod)
          {
              $order_product = new OrderProduct();
              $order_product->order_id = $order->id;
              $order_product->product_code = $prod;
              $order_product->quantity = $request->quantities[$key];
              $order_product->price = $request->prices[$key];
              $order_product->save();
          }
          $gen = Artisan::call('order:generate',['order' => $order->id]);
          $request->session()->flash('alert-success', "Thanks, your order has been placed. This is now viewable on your dashboard and you'll recieve an email confirmation shortly");
          Auth::user()->notify(new OrderPlaced($order->id));
          return redirect()->back();
      }
        catch(ErrorException $e)
        {
            dd($e);
            $request->session()->flash('alert-danger',$e);
            return redirect()->back()->withInput(Input::all())->withErrors($e);
        }

    }

}
