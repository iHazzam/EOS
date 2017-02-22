<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
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
              'address_line1' => 'required',
              'city' => 'required',
              'postcode' => 'required',
              'email' => 'required',
              'phone' => 'required',
              'project_name'=>'required',
              'purchase_order_reference'=>'required',
              'delivery' => 'required',
              'order_total' => 'required'
          ]);
          $error = false;
          $order = new Order();

          $order->address_line1 = $request->address_line1;
          $order->city = $request->city;
          $order->postcode = $request->postcode;
          $order->email = $request->email;
          $order->phone = $request->phone;
          $order->project_name = $request->project_name;
          $order->purchase_order_reference = $request->purchase_order_reference;
          $order->delivery = $request->delivery;
          $order->order_total = $request->order_total;

          if($request->has('address_line2'))
          {
              $order->address_line2 = $request->address_line2;
          }
          if($request->has('delivery_date'))
          {
              $order->delivery_date = $request->delivery_date;
          }
          if($request->has('shipping_total'))
          {
              $order->shipping_total = $request->shipping_total;
          }
          if($request->has('incoterms'))
          {
              $order->incoterms = $request->incoterms;
          }

          $order->user_id = Auth::user()->id;
          $order->save();
          foreach($request->products as $prod)
          {
              $order_product = new OrderProduct();
              $order_product->order_id = $order->id;
              $order_product->product_code = $prod->product_code;
              $order_product->quantity = $prod->quantity;
              if($prod->has('custom_order'))
              {
                  $order_product->custom_order = $prod->custom_order;
              }
              $order_product->save();
          }
          $request->session()->flash('alert-success', "Thanks, your order has been placed. This is now viewable on your dashboard and you'll recieve an email confirmation shortly");
          return redirect()->back();
      }
        catch(ErrorException $e)
        {
            $request->session()->flash('alert-danger',$e);
            return redirect()->back()->withInput(Input::all())->withErrors($e);
        }

    }

}
