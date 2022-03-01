<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\User;

class UserController extends Controller

{

  public function __construct()

   {

     //  $this->middleware('auth:api');

   }

   public function register(Request $request)
   {
    //dd($request);
   	$this->validate($request, [
			     'name'       => 'required|string|max:255',
           'email'      => 'required|string|max:255|unique:users|email|confirmed',
           'password' 	=> 'required|string|min:6',
        ]);

    try {
        	$user = User::create([
	            'name' 		  => $request['name'],
	            'email' 	  => $request['email'],
	            'password' 	=> app('hash')->make($request['password']),
	        ]);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['error'=>$exception->getMessage()]);
        }
        return response()->json(['status' => 'success', 'user' => $user]);
   }



   public function authenticate(Request $request)
   {
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only(['email', 'password']);

        if (! $token = Auth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
   }
   public function logout()
   {
      Auth::logout();
      return response()->json(['message' => 'Successfully logged out']);
   }
}