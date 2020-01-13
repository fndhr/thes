<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\lecturer;
use App\student;
use App\User;
use App\proposedAdvisor;
use App\proposedTitle;
use App\documentUpload;
use App\notification;
use Validator;
use App\session;
use DateTime;
use date;
class HomeController extends Controller
{
    
    public $role;//anggep 1 itu admin, 2 lecturer, 3 student
    public function __construct()
    {
        //$this->middleware('auth');
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
            $datetime = explode(' ',$student->session->title_adv_req_start);
            $student->session->title_adv_req_start = $datetime[0];
            $datetime = explode(' ',$student->session->title_adv_req_end);
            $student->session->passed_adv_title_dt = date('Ymd') > date('Ymd',strtotime($student->session->title_adv_req_end));
            $student->session->title_adv_req_end = $datetime[0];

            $datetime = explode(' ',$student->session->thesis_proposal_start);
            $student->session->thesis_proposal_start = $datetime[0];
            $datetime = explode(' ',$student->session->thesis_proposal_end);
            $student->session->passed_proposal_dt = date('Ymd') > date('Ymd',strtotime($student->session->thesis_proposal_end));
            $student->session->thesis_proposal_end = $datetime[0];

            $datetime = explode(' ',$student->session->interim_report_start);
            $student->session->interim_report_start = $datetime[0];
            $datetime = explode(' ',$student->session->interim_report_end);
            $student->session->passed_interim_dt = date('Ymd') > date('Ymd',strtotime($student->session->interim_report_end));
            $student->session->interim_report_end = $datetime[0];

            $datetime = explode(' ',$student->session->final_draft_start);
            $student->session->final_draft_start = $datetime[0];
            $datetime = explode(' ',$student->session->final_draft_end);
            $student->session->passed_final_draft_dt = date('Ymd') > date('Ymd',strtotime($student->session->final_draft_end));
            $student->session->final_draft_end = $datetime[0];

            $datetime = explode(' ',$student->session->signed_revised_doc_start_date);
            $student->session->signed_revised_doc_start_date = $datetime[0];
            $datetime = explode(' ',$student->session->signed_revised_doc_end_date);
            $student->session->passed_revised_doc_dt = date('Ymd') > date('Ymd',strtotime($student->session->signed_revised_doc_end_date));
            $student->session->signed_revised_doc_end_date = $datetime[0];

            $datetime = explode(' ',$student->session->finalized_doc_start_date);
            $student->session->finalized_doc_start_date = $datetime[0];
            $datetime = explode(' ',$student->session->finalized_doc_end_date);
            $student->session->passed_finalized_doc_dt = date('Ymd') > date('Ymd',strtotime($student->session->finalized_doc_end_date));
            $student->session->finalized_doc_end_date = $datetime[0];
            
            if(!is_null($student->defense)){
                $datetime = explode(' ',$student->defense->def_strt_dt);
                $date = explode('-',$datetime[0]);
                $time = explode(':',$datetime[1]);
                $student->defense->date = date('l, d F Y',strtotime($student->defense->def_strt_dt));
                $student->defense->time = $time[0].':'.$date[1];
                $student->defense->isToday = date('Ymd') == date('Ymd',strtotime($student->defense->date));
                $student->defense->passed = date('Ymd') > date('Ymd',strtotime($student->defense->date));                
            }
            return view('student.studentdashboard',[
                'role' => $this->role,
                'student' => $student,
                'proposedTitle' =>proposedTitle::whereStdId($student->std_id)->get(),
                'lecturers' =>lecturer::whereNotIn('lec_id',proposedAdvisor::whereStdId($student->std_id)->get('lec_id'))->whereIsadv(1)->get(),
                'proposedLecturers' =>proposedAdvisor::whereStdId($student->std_id)->get(),
                'progressUpload' => documentUpload::whereStdId($student->std_id)->get(),
                'countNotApprovedLecturer' =>count(proposedAdvisor::whereStdId($student->std_id)->whereStsId(1)->get()),
                'countNotApprovedTitle' =>count(proposedTitle::whereStdId($student->std_id)->whereStsId(1)->get()),
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
            'new_password' => 'required|min:8',
            'phone' => request('phone') != null ? 'min:10|regex:/(08)[0-9]{9}/' : '',
        ]);
        
        if ($validator->fails()) {dd(request('new_password'));
            $validator->validate();
        }
        if($request->has('new_password')){
            $user = User::whereId(auth()->id())->first();
            $user->phone = request('phone');
            $user->password = bcrypt(request('new_password'));
            $user->save();
			return redirect()->back()->with('alert','Account Data Changed Successfully');
        }
    }

    public function downloadFile(Request $request){

        $path = public_path("\uploads\\".request('studentId')."\ThesisProposal\\".request('ThesisProposal'));
        $file = request('ThesisProposal');

        return response()->download($path, $file);
    }

    public function downloadFileProposal(Request $request){

        $path = public_path("\uploads\\".request('studentId').'\\ThesisProposal\\'.request('ThesisProposal'));
        $file = request('ThesisProposal');

        return response()->download($path, $file);
    }

    public function downloadFileInterim(Request $request){

        $path = public_path("\uploads\\".request('studentId').'\\ThesisInterim\\'.request('ThesisInterim'));
        $file = request('ThesisInterim');

        return response()->download($path, $file);
    }

    public function downloadFileFinalDraft(Request $request){

        $path = public_path("\uploads\\".request('studentId')."\ThesisFinalDraft\\".request('FinalDraft'));
        $file = request('FinalDraft');
        
        return response()->download($path, $file);
    }

    public function downloadFileFinalizedDoc(Request $request){

        $path = public_path("\uploads\\".request('studentId')."\uploadFinalizedDoc\\".request('finalizedDoc'));
        $file = request('finalizedDoc');
        
        return response()->download($path, $file);
    }

    public function downloadFileRevisedDoc(Request $request){

        $path = public_path("\uploads\\".request('studentId')."\uploadSignedRevisedDoc\\".request('signedRevisedDoc'));
        $file = request('signedRevisedDoc');
        
        return response()->download($path, $file);
    }
}
