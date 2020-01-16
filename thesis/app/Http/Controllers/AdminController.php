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
use App\notification;
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
        return student::all();
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
            $student->defense->date = $date[1].'/'.$date[2].'/'.$date[0];
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
        date_default_timezone_set('Asia/Jakarta');
        //pepe janagn ilang
        $students = $this->getStudents();
        foreach($students as $student){
            foreach($student->proposedTitle as $title){
                if($title->sts_id==2)
                    $student->title_name = $title->title_name;
            }
            if(!is_null($student->defense)){
                $student->defense->isToday = date('Ymd') == date('Ymd',strtotime($student->defense->date));
                $student->defense->passed = date('Ymd') > date('Ymd',strtotime($student->defense->date));    
            }
        }
        return view('admin.studentsearch',[
            'role' => $this->role,
            'students' =>$students
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
        $student = student::whereStdId($param)->first();
        if($student->defense){
            $student->defense->date = date('l, d F Y',strtotime($student->defense->def_strt_dt));
            $student->defense->time = date('h:i:s A',strtotime($student->defense->def_strt_dt));
        }
        if(count($student->scoringTable) == 3){
            $a=0;$b=0;$c=0;
            foreach($student->scoringTable as $personalscore){
                $a+=$personalscore->final_report_total;
                $b+=$personalscore->presentation_total;
                $c+=$personalscore->supervisor_total;
            }
            $student->scoringTable->totalScore = round(($a/3)+($b/3)+$c, 2);    
        }
        else if($student->defense){
            $pusher = [];
            foreach($student->scoringTable as $personalscore){
                array_push($pusher,$personalscore->lec_id);
            }
            $eligible = [];
            array_push($eligible,$student->defense->examiner);
            array_push($eligible,$student->defense->chairman);
            array_push($eligible,$student->lec_id);
            $lecturers = lecturer::whereIn('lec_id',$eligible)->whereNotIn('lec_id',$pusher)->get();
            $student->scoringTable->lecturers = $lecturers;
        }
        return view('admin.studentdetail',[
            'role' => $this->role,
            'student' => $student,
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
        if(!is_null(User::find(auth()->id())->lecturer) ||!is_null(User::find(auth()->id())->student)){
            return redirect('home');
        }
        
        $nameSearch = request('std_name');
        $fullname = explode(' ',request('std_name'));

        $result = User::where('users.first_name','LIKE','%'.$nameSearch.'%')
                    ->orWhere('users.last_name','LIKE','%'.$nameSearch.'%')
                    ->orWhere('students.std_id','LIKE','%'.$nameSearch.'%')
                    ->orWhereIn('users.first_name',$fullname)->orWhereIn('users.last_name',$fullname)
                    ->leftJoin('students','users.id','=','students.usr_id')
                    ->get('id');
        date_default_timezone_set('Asia/Jakarta');
        //pepe janagn ilang
        $students = student::whereIn('usr_id',$result)->get();
        foreach($students as $student){
            foreach($student->proposedTitle as $title){
                if($title->sts_id==2)
                    $student->title_name = $title->title_name;
            }
            if(!is_null($student->defense)){
                $student->defense->isToday = date('Ymd') == date('Ymd',strtotime($student->defense->date));
                $student->defense->passed = date('Ymd') > date('Ymd',strtotime($student->defense->date));    
            }
        }
        
        return view('admin.studentsearch',[
            'role' => $this->role,
            'students' =>$students
        ]);
        
    }
    public function createSessionSet(Request $request){
        $validator = Validator::make($request->all(), [
            'session_id'=>'required|unique:sessions',
            'end_date_title_advisor'=>'required|date',
            'end_date_signed_thesis'=>'required|date|after:end_date_title_advisor',
            'end_date_interim'=>'required|date|after:end_date_signed_thesis',
            'end_date_final_draft'=>'required|date|after:end_date_interim',
            'minimum_consultation'=>['required','regex:/^[0-9]/']
        ]
        );
        if ($validator->fails()) {
            $validator->validate();
        }
        $session = new session;
        $session->minimum_consultation = request('minimum_consultation');
        $session->session_id = request('session_id');
        $date = explode('/',request('end_date_title_advisor'));
        $session->title_adv_req_end = DateTime::createFromFormat('Y-m-d', $date[2].'-'.$date[0].'-'.$date[1]);
        $date = explode('/',request('end_date_signed_thesis'));
        $session->thesis_proposal_end = DateTime::createFromFormat('Y-m-d', $date[2].'-'.$date[0].'-'.$date[1]);
        $date = explode('/',request('end_date_interim'));
        $session->interim_report_end = DateTime::createFromFormat('Y-m-d', $date[2].'-'.$date[0].'-'.$date[1]);
        $date = explode('/',request('end_date_final_draft'));
        $session->final_draft_end = DateTime::createFromFormat('Y-m-d', $date[2].'-'.$date[0].'-'.$date[1]);
        $session->save();
        return redirect()->back()->with('alert','Successfully Edit New Session');
    }
    public function editSessionSet(Request $request){
        $validator = Validator::make($request->all(), [
            'end_date_title_advisor'=>'required|date',
            'end_date_signed_thesis'=>'required|date|after:end_date_title_advisor',
            'end_date_interim'=>'required|date|after:end_date_signed_thesis',
            'end_date_final_draft'=>'required|date|after:end_date_interim',
            'minimum_consultation'=>['required','regex:/^[0-9]/']
        ]
        );
        if ($validator->fails()) {
            $validator->validate();
        }
        $session = session::whereSessionId(request('session_id'))->first();
        $session->minimum_consultation = request('minimum_consultation');
        $date = explode('/',request('end_date_title_advisor'));
        $session->title_adv_req_end = DateTime::createFromFormat('Y-m-d', $date[2].'-'.$date[0].'-'.$date[1]);
        $date = explode('/',request('end_date_signed_thesis'));
        $session->thesis_proposal_end = DateTime::createFromFormat('Y-m-d', $date[2].'-'.$date[0].'-'.$date[1]);
        $date = explode('/',request('end_date_interim'));
        $session->interim_report_end = DateTime::createFromFormat('Y-m-d', $date[2].'-'.$date[0].'-'.$date[1]);
        $date = explode('/',request('end_date_final_draft'));
        $session->final_draft_end = DateTime::createFromFormat('Y-m-d', $date[2].'-'.$date[0].'-'.$date[1]);
        $session->save();
        return redirect('admin/sessionSet')->with('alert','Successfully Edit Session '.request('session_id'));
    }
    public function submitSetDefenseSchedule(Request $request){
        //dd($request->input());
        $validator = Validator::make($request->all(), [
            'date'=>'required|date',
            'time'=>['required','regex:/^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/'],
            'room'=>'required',
            'chairman_id'=>'required',
            'examiner_id'=>'required|different:chairman_id',
        ],[
            '*.different'=>'Examiner and Chairman can not be the Same Person'
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
        $student = student::whereStdId(request('std_id'))->first();
        $defense->std_id = request('std_id');
        $defense->def_strt_dt = $startDate;
        $defense->def_end_dt = $endDate;
        $defense->room = request('room');
        $defense->examiner = request('examiner_id');
        $defense->chairman = request('chairman_id');
        $defense->save();

        $notification = new notification;
        $notification->message = "Hello, ".$student->user->first_name." ".$student->user->last_name.". Your defense schedule has been set. Please pay attention to the details in the defense section.";
        $notification->usr_id =  $student->usr_id;
        $notification->save();
            
        
        $notification = new notification;
        $notification->message = "Hello, ".$student->lecturer->user->first_name." ".$student->lecturer->user->last_name.". ".$student->user->first_name." ".$student->user->last_name."'s defense schedule has been set. Please pay attention to the details in the defense section.";
        $notification->usr_id =  $student->lecturer->usr_id;
        $notification->save();

        
        $notification = new notification;
        $notification->message = "Hello, ".$student->defense->examiner_name->user->first_name." ".$student->defense->examiner_name->user->last_name.". ".$student->user->first_name." ".$student->user->last_name."'s defense schedule has been set. Please pay attention to the details in the defense section.";
        $notification->usr_id =  $student->defense->examiner_name->usr_id;
        $notification->save();
        $notification = new notification;
        $notification->message = "Hello, ".$student->defense->chairman_name->user->first_name." ".$student->defense->chairman_name->user->last_name.". ".$student->user->first_name." ".$student->user->last_name."'s defense schedule has been set. Please pay attention to the details in the defense section.";
        $notification->usr_id =  $student->defense->chairman_name->usr_id;
        $notification->save();
        return redirect('admin/studentDetail/'.request('std_id'))->with('alert','Successfully Set Defense Schedule');
    }

    public function defenseSearchFilter(Request $request){
        if(!is_null(User::find(auth()->id())->lecturer) ||!is_null(User::find(auth()->id())->student)){
            return redirect('home');
        }
        
        $inputSearch = request('input_search');
        $fullname = explode(' ',request('input_search'));

        $defenses = defense::where('defenses.std_id','LIKE','%'.$inputSearch.'%')
                            ->where(function($q) {
                                $q->where('examiner', $this->user->lec_id)
                                ->orWhere('chairman', $this->user->lec_id)
                                ->orWhereHas('student',function($query){$query->where('lec_id',$this->user->lec_id);});})
                            ->where(function($q) {
                                $q->where('users.first_name','LIKE','%'.request('input_search').'%')
                                ->orWhere('users.last_name','LIKE','%'.request('input_search').'%')
                                ->orWhereIn('users.first_name',explode(' ',request('input_search')))->orWhereIn('users.last_name',explode(' ',request('input_search')));})
                            ->leftJoin('students','defenses.std_id','=','students.std_id')
                            ->leftJoin('users','students.usr_id','=','users.id')
                            ->get();

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
}
