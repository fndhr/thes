<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\lecturer;
use App\student;
use App\proposedAdvisor;
use App\proposedTitle;
class HomeController extends Controller
{
    
    public $role;//anggep 1 itu admin, 2 lecturer, 3 student
    public function __construct()
    {
        $this->middleware('auth');
        
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $isStudent = count(student::whereUsrId(auth()->id())->get()) == 0 ? false : true;        
        $isLecturer = count(lecturer::whereUsrId(auth()->id())->get())== 0 ? false : true;
        if($isStudent){
            $this->role = 3;
            $student = student::whereUsrId(auth()->id())->first();
            return view('student.studentdashboard',[
                'role' => $this->role,
                'student' => $student,
                'proposedTitle' =>proposedTitle::whereStdId($student->std_id)->get(),
                'lecturers' =>lecturer::whereNotIn('lec_id',proposedAdvisor::whereStdId($student->std_id)->get('lec_id'))->get(),
                'proposedLecturers' =>proposedAdvisor::whereStdId($student->std_id)->get()
            ]);
        }
        else if($isLecturer){
            $this->role = 2;
            return view('student.studentdashboard',[
                'role' => $this->role,
                'lecturer' =>lecturer::whereUsrId(auth()->id())->first()
            ]);
        }
        else{
            $this->role = 1;
            return view('admin.admindashboard',[
                'role'=> $this->role
            ]);
        }   
        
        
           
     
    }
}
