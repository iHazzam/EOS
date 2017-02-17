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
    public function showAdminStats()
    {
        //todo: get the stats they want to see
        return view('admin.stats')->with();
    }
    public function showCreateUserForm()
    {
        return view('admin.createuser');
    }
    public function createUser(Request $request)
    {
        //todo: create user post formmj
        
    }
    public function showEditForm()
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


}