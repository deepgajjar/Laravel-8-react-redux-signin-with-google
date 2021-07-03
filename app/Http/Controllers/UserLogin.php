<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\Userotherdetail;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\CssSelector\Node\FunctionNode;

class UserLogin extends Controller
{
    //
    public function RedirectToProvider(){
    
        // return Socialite::driver('google')->redirect();
    }
    public function HandleCallback(Request $request){
    
        $user_obj = User::where("email","=",$request->email)->count();
        if($user_obj == 0){
            $usr_obj = User::create([
                'name'=>$request->name,
                'password'=>uniqid(),
                'email'=>$request->email
            ]);

            $uo = new Userotherdetail();
            $uo->user_google_id = $request->googleId;
            $uo->user_profile_pic = $request->imageurl;
            $uo->google_token =$request->tokenId;

            $usr_obj->userotherdetail()->save($uo);
            $success['token'] =  $usr_obj->createToken('MyApp')-> accessToken; 
            return response()->json(['success' => $success],200); 
            
        }
        else{
        
        $already_user = User::where("email","=",$request->email)->first();
    
        $already_user->userotherdetail()->update([
            'google_token'=>$request->tokenId
        ]);

        $success['token'] =   $already_user->createToken('MyApp')->accessToken; 
        return response()->json(['success' => $success],200); 
        // return $already_user->createToken("myapp")->accessToken;
        }
       
    }


    public function user_email(Request $request){
        return $request->user();
    }
    public function unauthorize(){
        return response()->json(['status'=>'unauthorize'],401);
    }
    public function checkToken(Request $request){
        return response()->json(["tokenisvalid"=>True],200);
    }

    
    public function profile(Request $request){
        $uname = Auth::user()->name;
        return response()->json(["username"=>$uname],200);
    }

    public function logout(Request $request){
        $request->user()->tokens()->delete();
        return response()->json(["logout"=>true],200);
    }
}
