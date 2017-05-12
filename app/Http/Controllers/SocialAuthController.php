<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
class SocialAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback()
    {
        $user = Socialite::driver('facebook')->user();
        dd($user->id);
    }
    public function link(Request $request)
    {
        $user = Auth::user();
        $user->fbmid = $request->account;
        $request->session()->flash('alert-success', "Thanks, your account has been linked - please note, this cannot be verifed so if you have any trouble, please try again");
        return redirect()->back();
    }
}
