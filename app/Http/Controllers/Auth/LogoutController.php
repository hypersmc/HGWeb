<?php


namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class LogoutController extends Controller
{

    public function index() {

        $user = auth()->user();
        $user->setaccepted();
        Auth::logout();
        Alert::warning('Are you sure?', 'message')->persistent('Close');
        return redirect('login');

    }

}
