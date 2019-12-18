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
            'email' => 'required|email|unique:users',
            'std_id' => 'required|string|unique:students',
            'phone' => request('phone')!=null ? 'sometimes|min:10|regex:/(01)[0-9]{9}/' : '',
            'major_id' =>'required'
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

        $student = new student;
        $student->std_id = request('std_id');
        $student->usr_id = $user->id;
        $student->major_id = request('major_id');
        $student->save();
		
		return redirect()->back()->with('alert','successfull add student');
    }

    public function lecturerRegister(Request $request){
        
        $validator = Validator::make(request(), [
            'username' => 'required|unique:users|min:8|max:255',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'phone' =>  request('phone')!=null ? 'sometimes|min:10|regex:/(01)[0-9]{9}/' : '',
            'lec_id' => 'required|unique:lecturers'
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
        
        $lec = new lecturer;
        $lec->lec_id = request('lec_id');
        $lec->usr_id = $user->id;
        if(!is_null($request->input('isExm'))){
            $lec->isExm = 1;
        }
        if(!is_null($request->input('isAdv'))){
            $lec->isAdv = 1;
        }
        $lec->save();
		
		
		return redirect()->back()->with('alert','successfull add lecturer');
    }

    
}