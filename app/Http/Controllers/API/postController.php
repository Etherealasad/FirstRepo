<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class postController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['posts'] = post::all();
        return response($data);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = FacadesValidator::make($request->all(),
        [
        'title' => 'required', 
        'post' => 'required', 
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
    $user = post::create(
                [
                    'title' => $request->title,
                    'post' => $request->post,
                ]
                );
        if($user)
                    {
                        return response()->json([
                            'status'=> true,
                            'message'=> 'post data created  successfully',
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['posts'] = post::where('id',$id)->get();
        return response($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $post)
    {
        $validation = FacadesValidator::make($request->all(),
        [
        'title' => 'required', 
        'post' => 'required', 
        ]);

    if($validation->fails())
                {
                    return response()->json([
                        'status'=> false,
                        'message'=> 'validation error',
                        'error'=> $validation->errors()->all(),
                    ],401);
                }
//updating user data here,
    $user = post::where(['id' => $post])->update(
                [
                    'title' => $request->title,
                    'post' => $request->post,
                ]
                );
        if($user)
                    {
                        return response()->json([
                            'status'=> true,
                            'message'=> 'post data updated  successfully',
                            'user' => $user,
                        ],200);
                    }
                    else{
                        return response()->json([
                            'status'=> true,
                            'message'=> 'data not updated',
                        ],200);
    }
     }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user =  post::where(['id'=> $id])->delete();
        
    }
}
