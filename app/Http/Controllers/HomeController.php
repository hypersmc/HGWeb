<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        if (!$user->accepted){
            return view('home');
        }else if ($user->accepted) {
            return redirect('login');
        }else{
            return redirect('verify');
        }
    }
}
