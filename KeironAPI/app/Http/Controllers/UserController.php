<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Firebase\JWT\JWT;


class UserController extends Controller
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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index()
    {
     
     $users = User::all();
     return response()->json([
            'data'=> $users,
            'message'=>'success',
        ]);

    }

     public function create(Request $request)
     {
        $user = new User;
        $user = User::create($request->all());
        return response()->json([
            'data'=> $user,
            'message'=>'success',
        ]);
     }

     public function show($id)
     {
        $user = User::find($id);

        return response()->json($user);
     }

     public function update(Request $request, $id)
     { 
        $user= User::find($id);
        
        $user->nombre = $request->input('nombre');
        $user->TipoUser_id = $request->input('TipoUser_id');
        $user->mail = $request->input('mail');
        $user->save();
        return response()->json($user);
     }

     public function destroy($id)
     {
        $user = User::find($id);
        $user->delete();

         return response()->json('Usuario borrado con exito!');
     }


}