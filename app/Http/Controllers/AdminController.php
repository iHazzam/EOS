<?php

namespace App\Http\Controllers;

use App\Notifications\UserCreated;
use App\OrderProduct;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\User;
use App\Order;
class AdminController extends Controller
{
    //
    public function showAdminDashboard()
    {
        return view('admin.dashboard');
    }

    //
    public function showUsers()
    {
        $users = User::where('admin','=',null)->get();
        return view('admin.users')->with('users',$users);
    }
    public function showOrders()
    {
        $orders = Order::all();
        return view('admin.orders')->with('orders', $orders);
    }
    public function showCreateUserForm()
    {
        return view('admin.createuser');
    }
    public function createUser(Request $request)
    {
        try{
            $rules = [
                'contact_name' => 'required',
                'company_name'  => 'required',
                'contact_phone' => 'required',
                'email' => 'required',
                'address_line1' => 'required',
                'city' => 'required',
                'postcode' => 'required',
                'country' => 'required',
                'default_currency' => 'required',
                'sage_uid' => 'required'
            ];

            $this->validate($request,$rules);

            $user = new User();
            $user->contact_name = $request->contact_name;
            $user->company_name = $request->company_name;
            $user->contact_phone = $request->contact_phone;
            $user->email = $request->email;
            $user->address_line1 = $request->address_line1;
            $user->city = $request->city;
            $user->postcode = $request->postcode;
            $user->country = $request->country;
            $user->default_currency = $request->default_currency;
            $user->sage_uid = $request->sage_uid;

            if($request->has('address_line2'))
            {
                $user->address_line2 = $request->address_line2;
            }
            if($request->has('shipping_percent'))
            {
                $user->shipping_percent = $request->shipping_percent;
            }
            if($request->has('shipping_flat'))
            {
                $user->shipping_flat = $request->shipping_flat;
            }
            $password = $this->generatePassword(8);

            $user->password = bcrypt($password);

            $user->save();
            $user->notify(new UserCreated($user->email, $password));
            $request->session()->flash('alert-success', "Thanks! New User Registration complete!");
            return redirect()->back();}
            catch (QueryException $e){
                $request->session()->flash('alert-danger', "Account not created - probably a duplicate with the same email address!");
                return redirect()->back();
            }

    }
    function generatePassword($length = 8) {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $count = mb_strlen($chars);

        for ($i = 0, $result = ''; $i < $length; $i++) {
            $index = rand(0, $count - 1);
            $result .= mb_substr($chars, $index, 1);
        }

        return $result;
    }
    public function showEditUserForm()
    {
        return view('admin.edituser');
    }
    public function editUser(Request $request, User $user)
    {
        try{
            $rules = [
                'contact_name' => 'required',
                'company_name'  => 'required',
                'contact_phone' => 'required',
                'email' => 'required',
                'address_line1' => 'required',
                'city' => 'required',
                'postcode' => 'required',
                'country' => 'required',
                'default_currency' => 'required',
                'sage_uid' => 'required'
            ];

            $this->validate($request,$rules);

            $user->contact_name = $request->contact_name;
            $user->company_name = $request->company_name;
            $user->contact_phone = $request->contact_phone;
            $user->email = $request->email;
            $user->address_line1 = $request->address_line1;
            $user->city = $request->city;
            $user->postcode = $request->postcode;
            $user->country = $request->country;
            $user->default_currency = $request->default_currency;
            $user->sage_uid = $request->sage_uid;

            if($request->has('address_line2'))
            {
                $user->address_line2 = $request->address_line2;
            }
            if($request->has('shipping_percent'))
            {
                $user->shipping_percent = $request->shipping_percent;
            }
            if($request->has('shipping_flat'))
            {
                $user->shipping_flat = $request->shipping_flat;
            }
            $user->save();
            $request->session()->flash('alert-success', "User Edited Successfully");
            return redirect()->back();}
        catch (QueryException $e){
            $request->session()->flash('alert-danger', "Account not edited. Please try again");
            return redirect()->back();
        }

    }
    public function deleteUser(Request $request, User $user )
    {
        $user->delete();
        if($user->trashed())
        {
            $request->session()->flash('alert-success', "User successfully deleted from database!");
        }
        else{
            $request->session()->flash('alert-danger', "User not deleted. Invalid permissions or other error");
        }
        return back();
    }
    public function showEditOrderForm()
    {
        return view('admin.createuser');
    }
    public function editOrder(Request $request, Order $order)
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
            else{
                $order->address_line2 = null;
            }
            if($request->has('datepicker'))
            {
                $order->delivery_date = date("y-m-d", strtotime($request->datepicker));
            }
            else{
                $order->delivery_date = null;
            }

            $order->shipping_total = ($order->order_total * (Auth::user()->shipping_percent/100))+ Auth::user()->shipping_flat;


            if($request->has('incoterms'))
            {
                $order->incoterms = $request->incoterms;
            }
            else{
                $order->incoterms = null;
            }
            if($request->has('custom'))
            {
                $order->custom = $request->custom;
            }
            else{
                $order->custom = null;
            }
            $oid = $order->save();
            $order_products = OrderProduct::where('order_id','=',$order->id);
            foreach($request->products as $key => $prod)
            {
                $order_product = new OrderProduct();
                $order_product->order_id = $order->id;
                $order_product->product_code = $prod;
                $order_product->quantity = $request->quantities[$key];
                $order_product->price = $request->prices[$key];
                $order_product->save();
            }
            $request->session()->flash('alert-warning', "This order has now been updated - please rememeber this must also be manually updated in Sage.");
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
    public function deleteOrder(Request $request, Order $order)
    {
        $order->delete();
        if($order->trashed())
        {
            $request->session()->flash('alert-success', "Order successfully deleted from database!");
        }
        else{
            $request->session()->flash('alert-danger', "Order not deleted. Invalid permissions or other error");
        }
        return back();
    }
    public function showAdminSettings()
    {
        return view('admin.showsettings');
    }


}