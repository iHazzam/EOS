<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Prologue\Alerts\Facades\Alert;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }


    public function resetInternal(Request $request){
        if(Auth::user()->email == $request->email)
        {
            if($request->password == $request->password_confirmation)
            {
                Auth::user()->password = bcrypt($request->password);
                Auth::user()->save();
                Alert::add('info', 'Password Changed')->flash();

                return redirect('/')->with('alerts', Alert::all());
            }

            Alert::add('danger','Passwords do not match')->flash();


            return redirect()->back()->with('alerts', Alert::all());
        }
        Alert::add('danger','Rest failed - Please call Playdale to secure your account!')->flash();


        return redirect()->back()->with('alerts', Alert::all());

    }

}
