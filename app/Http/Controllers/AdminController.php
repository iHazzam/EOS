<?php

namespace App\Http\Controllers;

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
        $users = User::where('admin','=','0')->get();
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
        $request->session()->flash('alert-success', "Thanks! Registration complete!");
        return redirect()->back();

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
    public function deleteUser()
    {
        //todo: process delete user form
    }
    public function showEditOrderForm()
    {
        return view('admin.createuser');
    }
    public function editOrder(Request $request, User $user)
    {
        //todo: process edit user form
    }



}