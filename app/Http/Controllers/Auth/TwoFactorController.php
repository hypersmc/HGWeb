<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\TwoFactorCode;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class TwoFactorController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'twofactor']);
    }

    public function index()
    {
        $user = auth()->user();
        if ($user->once) {
            Alert::info('two factor key', 'An two factor key has been send to your mail.');
            $user->setonce();
            return view('auth.twoFactor');
        }
        return view('auth.twoFactor');
    }

    public function store(Request $request)
    {
        $request->validate([
            'two_factor_code' => 'integer|required',
        ]);

        $user = auth()->user();

        if($request->input('two_factor_code') == $user->two_factor_code)
        {
            $user->resetTwoFactorCode();
            $user->setfunctions();
            return redirect()->route('home');
        }
        Alert::error('Oops...', 'That two factor code is invalid!');

        return redirect()->back();

    }

    public function resend()
    {
        $user = auth()->user();
        $user->generateTwoFactorCode();
        $user->notify(new TwoFactorCode());
        Alert::info('New Two factor key', 'An new key has been send again');
        return redirect()->back();
    }
}
