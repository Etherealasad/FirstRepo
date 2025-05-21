<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //signup method
                public function signup(Request $request)
                    {
         //validating the form data here,
                        $validation = Validator::make($request->all(),
                        [
                        'name' => 'required', 
                        'email' => 'required|email|unique:Users,email', 
                        'password' => 'required',
                        ]);

                    if($validation->fails())
                                {
                                    return response()->json([
                                        'status'=> false,
                                        'message'=> 'validation error',
                                        'error'=> $validation->errors()->all(),
                                    ],401);
                                }
            //creating user data here,
                    $user = User::create(
                                [
                                    'name' => $request->name,
                                    'email' => $request->email,
                                    'password' => $request->password
                                ]
                                );
                        if($user)
                                    {
                                        return response()->json([
                                            'status'=> true,
                                            'message'=> 'data created  successfully',
                                            'user' => $user,
                                        ],200);
                                    }
                                    else{
                                        return response()->json([
                                            'status'=> true,
                                            'message'=> 'data not created',
                                        ],200);

                                    }
    } 

// login method
                                    public function login(Request $request)
                                    {
                                        //validating the form data here,
                                                    $validation = Validator::make($request->all(),
                                                    [
                                                    'email' => 'required|email', 
                                                    'password' => 'required',
                                                    ]);

                                                if($validation->fails())
                                                            {
                                                                return response()->json([
                                                                    'status'=> false,
                                                                    'message'=> 'validation error',
                                                                    'error'=> $validation->errors()->all(),
                                                                ],401);
                                                            }

                                        //authentication here,
                                        if(Auth::attempt(['email'=> $request->email, 'password'=>$request->password]))
                                        {
                                            $authuser = Auth::user();
                                            return response()->json([
                                                
                                                'status' => true,
                                                'message' => 'user logged in successfully!',
                                                'token' => $authuser->createToken("api token")->plainTextToken,
                                                'token_type' => 'bearer'

                                            ],200);

                                        } 
                                        else{
                                            return response()->json([
                                                'status' => false,
                                                'message' => 'email and password match  fails',
                                                'errors' =>  $validation->errors()->all()
                                            ],401);
                                        }                     
                                    }   









    
    public function logout(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();
        return response()->json([
            'status' => true,
            'user' => $user,
            'message' => 'User logged out successfully!',
            
        ],200);

    }

}
