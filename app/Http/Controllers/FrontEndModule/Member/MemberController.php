<?php

namespace App\Http\Controllers\FrontEndModule\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    //

    public function dashboard(){
        return view('site.page.dashboard');
    }
}
