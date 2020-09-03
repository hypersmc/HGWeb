<?php
namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class UserSettingsController extends Controller
{
    use AuthenticatesUsers;



    protected $redirectTo = RouteServiceProvider::USERSETTINGS;

    public function index() {
        return view('usersettings.usersettings');
    }

    public function usersettings()
    {
        $this->middleware('usersettings')->except('usersettings');
    }
}
