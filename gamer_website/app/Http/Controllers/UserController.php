<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Password;
use App\Http\Resources\userResource;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function index(){
        $users=User::all();
        return response()->json([
            'message'=>'All users',
            'Users'=> userResource::collection($users)
        ]);
    }    
   
    public function update(Request $request){
        $user=$request->user();
        $user->update($request->all());
        return response()->json([
            'message' => 'The account is succesfully updated !',
        ]);
    } 

    public function delete(){
        User::destroy(Auth()->user()->id);
        return response()->json([
            'message' => 'The account is succesfully deleted !'
        ]);
    } 

}
