<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\major;
use App\student;
use App\User;
use App\lecturer;
use App\proposedAdvisor;
use App\proposedTitle;
use App\defense;
use App\session;
use DateTime;
use date;
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
        if(!is_null(User::find(auth()->id())->lecturer) ||!is_null(User::find(auth()->id())->student)){
            return redirect('home');
        }
        return view('admin.sessionset',[
            'role' => $this->role,
            'sessions' => session::all()
        ]);
    }
    public function sessionEdit($param){
        if(!is_null(User::find(auth()->id())->lecturer) ||!is_null(User::find(auth()->id())->student)){
            return redirect('home');
        }
        $session = session::whereSessionId($param)->first();
        $session->title_adv_req_start = date('m/d/Y',strtotime($session->title_adv_req_start));
        $session->title_adv_req_end = date('m/d/Y',strtotime($session->title_adv_req_end));
        $session->thesis_proposal_start = date('m/d/Y',strtotime($session->thesis_proposal_start));
        $session->thesis_proposal_end = date('m/d/Y',strtotime($session->thesis_proposal_end));
        $session->interim_report_start = date('m/d/Y',strtotime($session->interim_report_start));
        $session->interim_report_end = date('m/d/Y',strtotime($session->interim_report_end));
        $session->final_draft_start = date('m/d/Y',strtotime($session->final_draft_start));
        $session->final_draft_end = date('m/d/Y',strtotime($session->final_draft_end));
        return view('admin.sessionedit',[
            'role' => $this->role,
            'session'=> $session
        ]);
    }
    public function studentProposal(){
        if(!is_null(User::find(auth()->id())->lecturer) ||!is_null(User::find(auth()->id())->student)){
            return redirect('home');
        }
        return view('admin.studentproposal',[
            'role' => $this->role
        ]);
    }
    public function setDefenseSchedule($param){
        if(!is_null(User::find(auth()->id())->lecturer) ||!is_null(User::find(auth()->id())->student)){
            return redirect('home');
        }
        $student = student::whereStdId($param)->first();
        $proposedTitle = proposedTitle::whereStdId($param)->whereStsId(2)->first();
        $student->title = $proposedTitle;
        if(!is_null($student->defense)){
            $datetime = explode(' ',$student->defense->def_strt_dt);
            $date = explode('-',$datetime[0]);
            $time = explode(':',$datetime[1]);
            $student->defense->date = $date[1].'/'.$date[0].'/'.$date[2];
            $student->defense->time = $time[0].':'.$date[1];
        }
        $examiner = lecturer::whereIsexm(1)->get();
        return view('admin.defensescheduleset',[
            'role' => $this->role,
            'student'=>$student,
            'examiners'=>$examiner,
            'chairmans'=>$examiner,
        ]);
    }
    public function getDefenseSchedule(){
        if(!is_null(User::find(auth()->id())->lecturer) ||!is_null(User::find(auth()->id())->student)){
            return redirect('home');
        }
        $defenses = defense::whereDate('def_strt_dt','>=',date('Y-m-d'))->get();
        foreach($defenses as  $defense){
            $datetime = explode(' ',$defense->def_strt_dt);
            $date = explode('-',$datetime[0]);
            $time = explode(':',$datetime[1]);
            $defense->date = $date[0].'-'.$date[1].'-'.$date[2];
            $defense->time = $time[0].':'.$date[1];
        }
        return view('admin.defenseschedulesearch',[
            'role' => $this->role,
            'defenses' => $defenses
        ]);
    }
    public function studentViewRegister(){
        if(!is_null(User::find(auth()->id())->lecturer) ||!is_null(User::find(auth()->id())->student)){
            return redirect('home');
        }
        return view('admin.studentregistration',[
            'role' => $this->role,
            'majors'=>$this->getMajor(),
            'students'=>$this->getStudents(),
            'sessions'=>session::all()
        ]);
    }
    public function lecturerViewRegister(){
        if(!is_null(User::find(auth()->id())->lecturer) ||!is_null(User::find(auth()->id())->student)){
            return redirect('home');
        }
        return view('admin.lecturerregistration',[
            'role' => $this->role,
            'lecturers' =>$this->getLecturers()
        ]);
    }
    public function studentSearch(){
        if(!is_null(User::find(auth()->id())->lecturer) ||!is_null(User::find(auth()->id())->student)){
            return redirect('home');
        }
        return view('admin.studentsearch',[
            'role' => $this->role,
            'students' =>$this->getStudents()
        ]);
    }
    public function getDefenseScheduleDetail($param){
        if(!is_null(User::find(auth()->id())->lecturer) ||!is_null(User::find(auth()->id())->student)){
            return redirect('home');
        }
        $student = student::whereStdId($param)->first();
        $proposedTitle = proposedTitle::whereStdId($param)->whereStsId(2)->first();
        $student->title = $proposedTitle;
        $student->date = date('l, d F Y',strtotime($student->defense->def_strt_dt));
        $student->time = date('h:i:s A',strtotime($student->defense->def_strt_dt)).' - '. date('h:i:s A',strtotime($student->defense->def_end_dt));
        return view('admin.defensescheduledetail',[
            'role' => $this->role,
            'student' => $student
        ]);
    }
    public function studentDetail($param){
        if(!is_null(User::find(auth()->id())->lecturer) ||!is_null(User::find(auth()->id())->student)){
            return redirect('home');
        }
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

        return redirect()->back()->with('alert','Successfully Approved Title');
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

        return redirect()->back()->with('alert','Successfully Approved Advisor');
    }
    public function disapproveTitle(Request $request){
        $proposedTitle = proposedTitle::whereTitleId(request('title'))->first();
        $proposedTitle->sts_id = 3;    
        $proposedTitle->save();
        return redirect()->back()->with('alert','Successfully Reject Title');
    }
    public function disapproveAdvisor(Request $request){
        $proposedAdvisor = proposedAdvisor::whereAdvisorId(request('advisor'))->first();
        $proposedAdvisor->sts_id = 3;
        $proposedAdvisor->save();
        return redirect()->back()->with('alert','Successfully Reject Advisor');
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
            'session_id'=>'required|unique:sessions',
            'start_date_title_advisor'=>'required|date',
            'end_date_title_advisor'=>'required|date|after:start_date_title_advisor',
            'start_date_signed_thesis'=>'required|date|after:end_date_title_advisor',
            'end_date_signed_thesis'=>'required|date|after:start_date_signed_thesis',
            'start_date_interim'=>'required|date|after:end_date_signed_thesis',
            'end_date_interim'=>'required|date|after:start_date_interim',
            'start_date_final_draft'=>'required|date|after:end_date_interim',
            'end_date_final_draft'=>'required|date|after:start_date_final_draft',
        ]
        );
        if ($validator->fails()) {
            $validator->validate();
        }
        $session = new session;
        $session->session_id = request('session_id');
        $date = explode('/',request('start_date_title_advisor'));
        $session->title_adv_req_start = DateTime::createFromFormat('Y-m-d', $date[2].'-'.$date[0].'-'.$date[1]);
        $date = explode('/',request('end_date_title_advisor'));
        $session->title_adv_req_end = DateTime::createFromFormat('Y-m-d', $date[2].'-'.$date[0].'-'.$date[1]);
        $date = explode('/',request('start_date_signed_thesis'));
        $session->thesis_proposal_start = DateTime::createFromFormat('Y-m-d', $date[2].'-'.$date[0].'-'.$date[1]);
        $date = explode('/',request('end_date_signed_thesis'));
        $session->thesis_proposal_end = DateTime::createFromFormat('Y-m-d', $date[2].'-'.$date[0].'-'.$date[1]);
        $date = explode('/',request('start_date_interim'));
        $session->interim_report_start = DateTime::createFromFormat('Y-m-d', $date[2].'-'.$date[0].'-'.$date[1]);
        $date = explode('/',request('end_date_interim'));
        $session->interim_report_end = DateTime::createFromFormat('Y-m-d', $date[2].'-'.$date[0].'-'.$date[1]);
        $date = explode('/',request('start_date_final_draft'));
        $session->final_draft_start = DateTime::createFromFormat('Y-m-d', $date[2].'-'.$date[0].'-'.$date[1]);
        $date = explode('/',request('end_date_final_draft'));
        $session->final_draft_end = DateTime::createFromFormat('Y-m-d', $date[2].'-'.$date[0].'-'.$date[1]);
        $session->save();
        return redirect()->back()->with('alert','Successfully Set New Session');
    }
    public function editSessionSet(Request $request){
        $validator = Validator::make($request->all(), [
            'start_date_title_advisor'=>'required|date',
            'end_date_title_advisor'=>'required|date|after:start_date_title_advisor',
            'start_date_signed_thesis'=>'required|date|after:end_date_title_advisor',
            'end_date_signed_thesis'=>'required|date|after:start_date_signed_thesis',
            'start_date_interim'=>'required|date|after:end_date_signed_thesis',
            'end_date_interim'=>'required|date|after:start_date_interim',
            'start_date_final_draft'=>'required|date|after:end_date_interim',
            'end_date_final_draft'=>'required|date|after:start_date_final_draft',
        ]
        );
        if ($validator->fails()) {
            $validator->validate();
        }
        $session = session::whereSessionId(request('session_id'))->first();
        $date = explode('/',request('start_date_title_advisor'));
        $session->title_adv_req_start = DateTime::createFromFormat('Y-m-d', $date[2].'-'.$date[0].'-'.$date[1]);
        $date = explode('/',request('end_date_title_advisor'));
        $session->title_adv_req_end = DateTime::createFromFormat('Y-m-d', $date[2].'-'.$date[0].'-'.$date[1]);
        $date = explode('/',request('start_date_signed_thesis'));
        $session->thesis_proposal_start = DateTime::createFromFormat('Y-m-d', $date[2].'-'.$date[0].'-'.$date[1]);
        $date = explode('/',request('end_date_signed_thesis'));
        $session->thesis_proposal_end = DateTime::createFromFormat('Y-m-d', $date[2].'-'.$date[0].'-'.$date[1]);
        $date = explode('/',request('start_date_interim'));
        $session->interim_report_start = DateTime::createFromFormat('Y-m-d', $date[2].'-'.$date[0].'-'.$date[1]);
        $date = explode('/',request('end_date_interim'));
        $session->interim_report_end = DateTime::createFromFormat('Y-m-d', $date[2].'-'.$date[0].'-'.$date[1]);
        $date = explode('/',request('start_date_final_draft'));
        $session->final_draft_start = DateTime::createFromFormat('Y-m-d', $date[2].'-'.$date[0].'-'.$date[1]);
        $date = explode('/',request('end_date_final_draft'));
        $session->final_draft_end = DateTime::createFromFormat('Y-m-d', $date[2].'-'.$date[0].'-'.$date[1]);
        $session->save();
        return redirect('admin/sessionSet')->with('alert','Successfully Edit Session '.request('session_id'));
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
        $endDate = DateTime::createFromFormat('Y-m-d H:i:s', $date[2].'-'.$date[0].'-'.$date[1].' '.request('time').':00')->modify('+2 hours');
        if(count(defense::whereStdId(request('std_id'))->get())>0){
            $defense = defense::whereStdId(request('std_id'))->first();
        }
        else{
            $defense = new defense;
        }
        $defense->std_id = request('std_id');
        $defense->def_strt_dt = $startDate;
        $defense->def_end_dt = $endDate;
        $defense->room = request('room');
        $defense->examiner = request('examiner_id');
        $defense->chairman = request('chairman_id');
        $defense->save();

        return redirect('admin/studentDetail/'.request('std_id'))->with('alert','Successfully Set Defense Schedule');
    }
}
