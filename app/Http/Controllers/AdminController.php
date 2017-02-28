<?php

namespace App\Http\Controllers;

use App\Notifications\UserCreated;
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
        //todo: process edit user form
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
    public function editOrder(Request $request, User $user)
    {
        //todo: process edit user form
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


}