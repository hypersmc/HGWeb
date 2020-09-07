<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (session('logout')){
            Alert::info('Logout', 'Your logout was successful');
        }
        $user = auth()->user();
        if (!$user->accepted){
            Alert::success('Login successful', 'Welcome!');
            return view('home');
        }else if ($user->accepted) {
            return redirect('login');
        }else{
            return redirect('verify');
        }
    }
}
