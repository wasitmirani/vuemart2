<?php

namespace App\Http\Controllers\Admin\App;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AppSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AppController extends Controller
{
    //


    public function WebsiteInfo(Request $request){
        $appcontent=AppSetting::first();
        return response()->json($appcontent);
    }

    public function WebsitesocialUpdate(Request $request){
        $appcontent=AppSetting::first();
        $appcontentdata=AppSetting::where('id',$appcontent->id)->update([
            'twitter'=>$request->twitter,
            'facebook'=>$request->facebook,
            'instagram'=>$request->instagram,
        ]);
        return response()->json($appcontentdata);
    }
    public function WebsiteInfoUpdate(Request $request){
        $appcontent=AppSetting::first();
        $appcontentdata=AppSetting::where('id',$appcontent->id)->update([
            'contact'=>$request->contact,
            'email'=>$request->email,
            'tagcontent'=>$request->tagcontent,
            'timing'=>$request->timing,
            'address1'=>$request->address1,
            'address2'=>$request->address2,
            'address2'=>$request->address2,
            'zipcode'=>$request->zipcode,
            'city'=>$request->city,
            'state'=>$request->state,
            'country'=>$request->country,
            'country'=>$request->country,
        ]);
        return response()->json($appcontentdata);
    }
    public function AccountUpdate(Request $request){
        $user=User::where('id',$request->id)->first();
        if(!empty($request->password)){
            $checkpassword=Hash::check($request->oldpassword, $user->password);
            if($checkpassword)
             $password=Hash::make($request->password);
            else
            return response()->json(['oldpassword'=>'The password is incorrect'],403);
        }
        else
        $password=$user->password;

        User::where('id',$request->id)->update(['name'=>$request->name,'email'=>$request->email,'phone'=>$request->phone,'password'=>$password]);

        return response()->json();

    }
    public function UserThumbnailUpdate(Request $request){

        $name = !empty($request->name) ? $request->name : config('app.name');
        if ($request->hasfile('file')) {
            $name = Str::slug($name, '-')  . "-" . time() . '.' . $request->file->extension();

            $request->file->move(public_path("/admin/img/users/"), $name);
        }

          User::where('id',$request->id)->update(['thumbnail'=>$name]);

    }
}
