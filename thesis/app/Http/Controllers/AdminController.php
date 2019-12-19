<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\major;
use App\student;
use App\lecturer;

class AdminController extends Controller
{
    private $role = 1;
    public function __construct()
    {
        $this->middleware('auth');   
    }
    public function getStudents(){
        return student::paginate(10);
    }
    public function getLecturers(){
        return lecturer::all();
    }
    public function getMajor(){
        return major::all();
    }
    public function sessionSet(){
        return view('admin.sessionset',[
            'role' => $this->role
        ]);
    }
    public function studentProposal(){
        return view('admin.studentproposal',[
            'role' => $this->role
        ]);
    }
    public function setDefenseSchedule(){
        return view('admin.defensescheduleset',[
            'role' => $this->role
        ]);
    }
    public function getDefenseSchedule(){
        return view('admin.defenseschedulesearch',[
            'role' => $this->role
        ]);
    }
    public function studentViewRegister(){
        return view('admin.studentregistration',[
            'role' => $this->role,
            'majors'=>$this->getMajor(),
            'students'=>$this->getStudents()
        ]);
    }
    public function lecturerViewRegister(){
        return view('admin.lecturerregistration',[
            'role' => $this->role,
            'majors' =>$this->getMajor(),
            'lecturers' =>$this->getLecturers()
        ]);
    }
    public function studentSearch(){
        return view('admin.studentsearch',[
            'role' => $this->role,
            'students' =>$this->getStudents()
        ]);
    }
    public function getDefenseScheduleDetail($param){
        return view('admin.defensescheduledetail',[
            'role' => $this->role
        ]);
    }
    public function studentDetail($param){
        return view('admin.studentdetail',[
            'role' => $this->role
        ]);
    }
}
