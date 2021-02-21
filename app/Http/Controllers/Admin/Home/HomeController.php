<?php

namespace App\Http\Controllers\Admin\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //

    public function index(){
        switch (Auth::user()->role_id) {
            case '1':
                return redirect()->route('member.dashboard');
                break;
                case '2':
                    return view('dashboard.page.home');
                break;

            default:
            return redirect()->route('login');
                break;
        }
        return redirect()->route('login');

    }
}
