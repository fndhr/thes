<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\major;
use App\student;
use App\User;
use App\lecturer;
use App\proposedAdvisor;
use App\proposedTitle;
class AdminController extends Controller
{
    private $role = 1;
    public function __construct()
    {
        $this->middleware('auth');   
    }
    public function getStudents(){
        return student::paginate(20);
    }
    public function getLecturers(){
        return lecturer::paginate(20);
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
            'role' => $this->role,
            'student' => student::whereStdId($param)->first(),
            'numberPropTitle' => count(proposedTitle::whereStdId($param)->whereStsId(1)->get()),
            'numberPropAdv' => count(proposedAdvisor::whereStdId($param)->whereStsId(1)->get()),
        ]);
    }
    public function approveTitle(Request $request){
        $proposedTitles = proposedTitle::whereStdId(request('std'))->get();
        foreach ($proposedTitles as $proposedTitle) {
            if($proposedTitle->title_id == request('title')){
                $proposedTitle->sts_id = 2;
            }
            else{
                $proposedTitle->sts_id = 3;
            }
            $proposedTitle->save();
        }

        return redirect()->back()->with('alert','successfully approved title');
    }
    public function approveAdvisor(Request $request){
        $proposedAdvisors = proposedAdvisor::whereStdId(request('std'))->get();
        foreach ($proposedAdvisors as $proposedAdvisor) {
            if($proposedAdvisor->advisor_id == request('advisor')){
                $proposedAdvisor->sts_id = 2;
                $proposedAdvisor->student->lec_id = $proposedAdvisor->lec_id;
                $proposedAdvisor->student->save();
            }
            else{
                $proposedAdvisor->sts_id = 3;
            }
            $proposedAdvisor->save();
        }

        return redirect()->back()->with('alert','successfully approved advisor');
    }
    public function disapproveTitle(Request $request){

    }
    public function disapproveAdvisor(Request $request){
        return redirect()->back()->with('alert','ini disapprove advisor');
    }

    public function studentSearchFilter(Request $request){
        $nameSearch = request('std_name');

        $result = User::where('first_name','LIKE','%'.$nameSearch.'%')
                    ->orWhere('last_name','LIKE','%'.$nameSearch.'%')->get('id');

        if(count($result) > 0){
            return view('admin.studentsearch',[
                'role' => $this->role,
                'students' =>student::whereIn('usr_id',$result)->get()
            ]);
        }
    }
}
