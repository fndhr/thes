<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\lecturer;
use App\student;
use App\User;
use App\proposedAdvisor;
use App\proposedTitle;
use App\documentUpload;
use Validator;
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
            if(!is_null($student->defense)){
                $datetime = explode(' ',$student->defense->def_strt_dt);
                $date = explode('-',$datetime[0]);
                $time = explode(':',$datetime[1]);
                $student->defense->date = date('l, d F Y',strtotime($student->defense->def_strt_dt));
                $student->defense->time = $time[0].':'.$date[1];
            }
            return view('student.studentdashboard',[
                'role' => $this->role,
                'student' => $student,
                'proposedTitle' =>proposedTitle::whereStdId($student->std_id)->get(),
                'lecturers' =>lecturer::whereNotIn('lec_id',proposedAdvisor::whereStdId($student->std_id)->get('lec_id'))->get(),
                'proposedLecturers' =>proposedAdvisor::whereStdId($student->std_id)->get(),
                'progressUpload' => documentUpload::whereStdId($student->std_id)->get()
            ]);
        }
        else if($isLecturer){
            $this->role = 2;
            return view('lecturer.dashboard',[
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

    public function changePassword(Request $request){
        $validator = Validator::make($request->all(), [
            'new_password' => 'required|min:8'
        ]);
        if ($validator->fails()) {
            $validator->validate();
        }
        if($request->has('new_password')){
            $user = User::whereId(auth()->id())->first();

            $user->password = bcrypt(request('new_password'));
            $user->save();
			return redirect()->back()->with('alert','Password Changed Successfully');
        }
    }
}
