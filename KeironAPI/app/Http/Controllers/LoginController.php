<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Firebase\JWT\JWT;


class LoginController extends Controller
{

      /**
     * Create a new token.
     * 
     * @param  \App\User   $user
     * @return string
     */
    protected function jwt(User $user) {
        $payload = [
            'iss' => "lumen-jwt", // Issuer of the token
            'sub' => $user->id, // Subject of the token
            'iat' => time(), // Time when JWT was issued. 
            'exp' => time() + 60*60 // Expiration time
        ];
        
        // As you can see we are passing `JWT_SECRET` as the second parameter that will 
        // be used to decode the token in the future.
        return JWT::encode($payload, env('JWT_SECRET'));
    } 

    

     public function login(Request $request)
     { 
        $user= User::all()->whereIn('mail',$request->mail)->first();
        
        if (($user->mail == $request->mail) && ($user->password == $request->password) ) {
            
             return response()->json([
                'message'   =>'success',
                'perfil'    => $user->TipoUser_id,
                'token'     => 'Bearer '.$this->jwt($user)
            ], 200);
        }else{
            return response()->json(['status' => 'fail'],401);
        }
     }


    }