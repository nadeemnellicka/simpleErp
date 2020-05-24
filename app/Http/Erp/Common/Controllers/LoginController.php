<?php

namespace App\Http\Erp\Common\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request){
    	$login = $request->validate([
    		'email' => 'required|string',
    		'password' => 'required|string'
    	]);
    	if(!Auth::attempt($login)){
    		return response(['message'=>'Invalid user broo...!!']);
    	}
    	$accessToken=Auth::user()->createToken('authToken')->accessToken;
    	return response(['user'=>Auth::user(),'access_token'=>$accessToken,'status'=>'success','token'=>$accessToken]);
        }
    public function details(){
            $user=Auth::user();
            return response()->json(['user'=>$user]); 
        }
    public function logout()
        {                                                                                                                                                             
            $token = Auth::user()->token();
            $token->revoke();
            $response = 'You have been succesfully logged out!';
            return response($response, 200);
        } 
   function register(Request $request)
    {
        $valid = validator($request->only('email', 'name', 'password'), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);
        if ($valid->fails()) {
            $jsonError=response()->json($valid->errors()->all(), 400);
            return response(['status'=>'error','message'=>$jsonError]);
        }
        $data = request()->only('email','name','password','mobile');
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);
        $login = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);
        if(!Auth::attempt($login)){
            return response(['message'=>'Invalid user broo...!!']);
        }
        $accessToken=Auth::user()->createToken('authToken')->accessToken;
        return response(['user'=>Auth::user(),'access_token'=>$accessToken,'status'=>'success','token'=>$accessToken]);

  
    }
}

