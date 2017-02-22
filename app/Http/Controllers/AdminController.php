<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
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
        return view('admin.users')->with($users);;
    }
    public function showOrders()
    {
        return view('admin.orders');
    }
    public function showCreateUserForm()
    {
        return view('admin.createuser');
    }
    public function createUser(Request $request)
    {
        //todo: create user post form
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