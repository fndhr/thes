<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use App\User;
use App\student;
use App\lecturer;

class UserController extends Controller
{
    public function studentRegister(Request $request){
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users|min:8|max:255',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|unique:users'
        ]);
        if ($validator->fails()) {
            $validator->validate();
        }
        $user = new User;
        $user->username = request('username');
        $user->password = bcrypt(request('password'));
        $user->first_name = request('first_name');
        $user->last_name = request('last_name'); 
        $user->email = request('email');
        $user->phone = request('phone');
        $user->save();
    }

    public function lecturerRegister(){
        $validator = Validator::make(request(), [
            'username' => 'required|unique:users|min:8|max:255',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|unique:users'
        ]);
        if ($validator->fails()) {
            $validator->validate();
        }
        $user = new User;
        $user->username = request('username');
        $user->password = bcrypt(request('password'));
        $user->first_name = request('first_name');
        $user->last_name = request('last_name'); 
        $user->email = request('email');
        $user->phone = request('phone');
        $user->save();
    }

    
}
