<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\TwoFactorController;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Support\Renderable|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function index()
    {
        $user = auth()->user();
        try {

            if ($user->accepted) {
                if ($user->once) {
                    Alert::success('Login successful', 'Welcome!');
                    $user->setonce();
                    return view('home');
                }
                return view('home');
            }
        } catch (\Throwable $e) {
            return redirect('login');
        }
    }
}
