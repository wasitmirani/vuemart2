<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    //
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {

        try {

            $user = Socialite::driver('google')->user();

            $finduser = User::where('google_id', $user->id)->orWhere('email',$user->email)->first();

            if($finduser){

                Auth::login($finduser);

                return redirect('/home');

            }else{

                $thumbnail=$user->avatar;

                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'thumbnail'=>$thumbnail,
                    'role_id'=>1,
                    'password' => Hash::make($user->email)

                ]);

                Auth::login($newUser);

                return redirect('/home');
            }

        } catch (\Throwable $th) {
            return redirect()->route('index');
        }
    }
}
