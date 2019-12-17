<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\lecturer;
use App\student;

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
    public function index()
    {
        $isStudent = count(student::whereUsrId(auth()->id())->get()) == 0 ? false : true;        
        $isLecturer = count(lecturer::whereUsrId(auth()->id())->get())== 0 ? false : true;
        if($isStudent)
            $this->role = 3;
        else if($isLecturer)
            $this->role = 2;
        else
            $this->role = 1;
        //ambil role harusnya ga disini pepe, di construct.. cman ada masalah tuh asw, jadi gue taruh sini 

        if($this->role == 1)
            return view('admin.userregistration',[
                'role'=> $this->role
            ]);
        else
            return view('home',[
                'role' => $this->role,
                'student' =>student::whereUsrId(auth()->id())->first(),
                'lecturer' =>lecturer::whereUsrId(auth()->id())->first()
            ]);
     
    }
}
