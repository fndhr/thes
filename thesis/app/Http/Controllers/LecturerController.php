<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\lecturer;
use App\student;
class LecturerController extends Controller
{
    private $role = 2;
    private $user;
    public function __construct()
    {
        $this->middleware('auth');   
    }
    public function validateLecturer(){
        $this->user = User::find(auth()->id())->lecturer;
    }
    public function getStudents(){
        return student::paginate(20);
    }
    public function studentSearch(){
        $this->validateLecturer();
        if(is_null($this->user)){
            return redirect('home');
        }
        return view('lecturer.studentsearch',[
            'role' => $this->role,
            'students' =>$this->getStudents(),
            'lecturer' => $this->user
        ]);
    }
}
