<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\major;
use App\student;
use App\User;
use App\lecturer;
use App\proposedAdvisor;
use App\proposedTitle;
use DateTime;
use Validator;
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
    public function setDefenseSchedule($param){
        $student = student::whereStdId($param)->first();
        $proposedTitle = proposedTitle::whereStdId($param)->whereStsId(2)->first();
        $student->title = $proposedTitle;
        $examiner = lecturer::whereIsexm(1)->get();
        return view('admin.defensescheduleset',[
            'role' => $this->role,
            'student'=>$student,
            'examiners'=>$examiner,
            'chairmans'=>$examiner,
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

        
        return view('admin.studentsearch',[
            'role' => $this->role,
            'students' =>student::whereIn('usr_id',$result)->get()
        ]);
        
    }
    public function createSessionSet(Request $request){
        $validator = Validator::make($request->all(), [
            'start_date_title_advisor'=>'required|date',
            'end_date_title_advisor'=>'required|date|after:start_date_title_advisor',
            'start_date_signed_thesis'=>'required|date',
            'end_date_signed_thesis'=>'required|date|after:start_date_signed_thesis',
            'start_date_interim'=>'required|date',
            'end_date_interim'=>'required|date|after:start_date_interim',
            'start_date_final_draft'=>'required|date',
            'end_date_final_draft'=>'required|date|after:start_date_final_draft',
        ]
        );
        if ($validator->fails()) {
            $validator->validate();
        }
    }
    public function submitSetDefenseSchedule(Request $request){
        $validator = Validator::make($request->all(), [
            'date'=>'required|date',
            'time'=>['required','regex:/^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/'],
            'room'=>'required',
            'examiner_id'=>'required',
            'chairman_id'=>'required',
        ]
        );
        if ($validator->fails()) {
            $validator->validate();
        }
        $date = explode('/',request('date'));
        $startDate = DateTime::createFromFormat('Y-m-d H:i:s', $date[2].'-'.$date[0].'-'.$date[1].' '.request('time').':00');
        $endDate = $startDate->modify('+1 day');
        $defense = new defense;
        $defense->std_id = request('std_id');
        $defense->def_strt_dt = $startDate;
        $defense->def_end_dt = $endDate;
        $defense->examiner = request('examiner_id');
        $defense->chairman = request('chairman_id');
    }
}
