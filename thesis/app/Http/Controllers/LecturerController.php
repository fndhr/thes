<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\lecturer;
use App\student;
use App\proposedAdvisor;
use App\defense;
use App\proposedTitle;
use App\scoringTable;
use App\documentUpload;
use App\proposedConsultation;
use App\questionScoringSheet;
use App\notification;
use DB;
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
        return student::where('lec_id',$this->user->lec_id)->get();
    }

    public function studentSearch(){
        $this->validateLecturer();
        date_default_timezone_set('Asia/Jakarta');
        if(is_null($this->user)){
            return redirect('home');
        }
        $students = $this->getStudents();
        foreach($students as $student){
            if(!is_null($student->defense)){
                $student->defense->isToday = date('Ymd') == date('Ymd',strtotime($student->defense->def_strt_dt));
                $student->defense->passed = date('Ymd') > date('Ymd',strtotime($student->defense->def_strt_dt));    
            }
        }
        return view('lecturer.studentsearch',[
            'role' => $this->role,
            'students' =>$students,
            'lecturer' => $this->user
        ]);
    }

    public function studentDetail($param){
        $this->validateLecturer();
        if(is_null($this->user)){
            return redirect('home');
        }
        $student = student::whereStdId($param)->first();
        if($student->defense){
            $student->defense->date = date('l, d F Y',strtotime($student->defense->def_strt_dt));
            $student->defense->time = date('h:i:s A',strtotime($student->defense->def_strt_dt));
        }
        foreach($student->proposedConsultations as $consult){
            $consult->proposed_date = date('d F Y',strtotime($consult->proposed_date));
        }
        if(count($student->scoringTable) == 3){
            $a=0;$b=0;$c=0;
            foreach($student->scoringTable as $personalscore){
                $a+=$personalscore->final_report_total;
                $b+=$personalscore->presentation_total;
                $c+=$personalscore->supervisor_total;
            }
            $student->scoringTable->totalScore = round(($a/2)+($b/2)+$c, 2);    
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
        return view('lecturer.studentdetail',[
            'role' => $this->role,
            'student' => $student,
            'lecturer' => $this->user,
            'numberPropTitle' => count(proposedTitle::whereStdId($param)->whereStsId(1)->get()),
            'numberPropAdv' => count(proposedAdvisor::whereStdId($param)->whereStsId(1)->get()),
        ]);
    }
    public function defenseScheduleSearch(){
        $this->validateLecturer();
        if(is_null($this->user)){
            return redirect('home');
        }
        $defenses = defense::whereDate('def_strt_dt','>=',date('Y-m-d'))
        ->where(function($q) {
            $q->where('examiner', $this->user->lec_id)
              ->orWhere('chairman', $this->user->lec_id)
              ->orWhereHas('student',function($query){$query->where('lec_id',$this->user->lec_id);})
        ;
        })->get();
        foreach($defenses as  $defense){
            $datetime = explode(' ',$defense->def_strt_dt);
            $date = explode('-',$datetime[0]);
            $time = explode(':',$datetime[1]);
            $defense->date = $date[0].'-'.$date[1].'-'.$date[2];
            $defense->time = $time[0].':'.$date[1];
        }
        return view('lecturer.defenseschedulesearch',[
            'role' => $this->role,
            'lecturer' => $this->user,
            'defenses' => $defenses
        ]);
    }

    public function getDefenseScheduleDetail($param){
        $this->validateLecturer();
        if(is_null($this->user)){
            return redirect('home');
        }
        date_default_timezone_set('Asia/Jakarta');
        $student = student::whereStdId($param)->first();
        $proposedTitle = proposedTitle::whereStdId($param)->whereStsId(2)->first();
        $student->title = $proposedTitle;
        $student->date = date('l, d F Y',strtotime($student->defense->def_strt_dt));
        $student->time = date('h:i:s A',strtotime($student->defense->def_strt_dt)).' - '. date('h:i:s A',strtotime($student->defense->def_end_dt));
        $student->isPostDefenseDate = ((int)date('Ymd')) >= ((int)date('Ymd',strtotime($student->defense->def_strt_dt)));
        $liveScoringHasNotSubmit = count(scoringTable::whereStdId($param)->whereLecId($this->user->lec_id)->get())==0;
        return view('lecturer.defensescheduledetail',[
            'role' => $this->role,
            'lecturer' => $this->user,
            'student' => $student,
            'liveScoringHasNotSubmit' => $liveScoringHasNotSubmit
        ]);
    }
    public function defenseScoring($param){
        $this->validateLecturer();
        if(is_null($this->user)){
            return redirect('home');
        }
        $student = student::whereStdId($param)->first();
        $proposedTitle = proposedTitle::whereStdId($param)->whereStsId(2)->first();
        $student->title = $proposedTitle;
        $student->date = date('l, d F Y',strtotime($student->defense->def_strt_dt));
        $student->time = date('h:i:s A',strtotime($student->defense->def_strt_dt)).' - '. date('h:i:s A',strtotime($student->defense->def_end_dt));
        $report = questionScoringSheet::whereType('1')->get();
        $presentation = questionScoringSheet::whereType('2')->get();
        $advisor = questionScoringSheet::whereType('3')->get();
        return view('lecturer.defensescoring',['role' => $this->role,
        'lecturer' => $this->user,'student' => $student,'reports'=>$report,'presentation'=>$presentation,'advisor'=>$advisor]);
    }
    public function studentSearchFilter(Request $request){
        $this->validateLecturer();
        if(is_null($this->user)){
            return redirect('home');
        }
        $nameSearch = request('std_name');
        $fullname = explode(' ',request('std_name'));
        date_default_timezone_set('Asia/Jakarta');
        $result = User::where(function($q) {
                        $q->where('users.first_name','LIKE','%'.request('std_name').'%')
                        ->orWhere('users.last_name','LIKE','%'.request('std_name').'%')
                        ->orWhere('students.std_id','LIKE','%'.request('std_name').'%')
                        ->orWhereIn('users.first_name',explode(' ',request('std_name')))->orWhereIn('users.last_name',explode(' ',request('std_name')));})
                    ->where('lec_id',$this->user->lec_id)
                    ->leftJoin('students','users.id','=','students.usr_id')
                    ->get('id');
        $students = student::whereIn('usr_id',$result)->get();
        foreach($students as $student){
            if(!is_null($student->defense)){
                $student->defense->isToday = date('Ymd') == date('Ymd',strtotime($student->defense->def_strt_dt));
                $student->defense->passed = date('Ymd') > date('Ymd',strtotime($student->defense->def_strt_dt));    
            }
        }
        return view('lecturer.studentsearch',[
            'role' => $this->role,
            'students' =>$students,
            'lecturer' => $this->user
        ]);        
    }

    public function defenseSearchFilter(Request $request){
        $this->validateLecturer();
        if(is_null($this->user)){
            return redirect('home');
        }
        $inputSearch = request('input_search');
        $fullname = explode(' ',request('input_search'));

        $defenses = defense::where(function($q) {
                                $q->where('examiner', $this->user->lec_id)
                                ->orWhere('chairman', $this->user->lec_id)
                                ->orWhereHas('student',function($query){$query->where('lec_id',$this->user->lec_id);});})
                            ->where(function($q) {
                                $q->where('users.first_name','LIKE','%'.request('input_search').'%')
                                ->orWhere('users.last_name','LIKE','%'.request('input_search').'%')
                                ->orWhere('defenses.std_id','LIKE','%'.request('input_search').'%')
                                ->orWhereIn('users.first_name',explode(' ',request('input_search')))->orWhereIn('users.last_name',explode(' ',request('input_search')));})
                            ->whereDate('def_strt_dt','>=',date('Y-m-d'))
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
        return view('lecturer.defenseschedulesearch',[
            'role' => $this->role,
            'defenses' => $defenses,
            'lecturer' => $this->user
        ]);
    }

    public function submitScoring(){
        $totalReport = 0; $totalPresentation = 0; $totalAdvisor = 0;
        if(is_null(request('advisor'))){
            foreach(request('final_report') as $nilai){
                $totalReport+=$nilai;
            }
            foreach(request('presentation') as $nilai){
                $totalPresentation+=$nilai;
            }
        }
        if(!is_null(request('advisor'))){
            foreach(request('advisor') as $nilai){
                $totalAdvisor+=$nilai;
            }
        }
        $scoring = new scoringTable;
        $scoring->final_report_total = $totalReport;
        $scoring->presentation_total = $totalPresentation;
        $scoring->supervisor_total = $totalAdvisor;
        if(is_null(request('suggestion')))
            $scoring->suggestion = "";
        else
            $scoring->suggestion = request('suggestion');
        if(is_null(request('suggestion')))
            $scoring->correction = "";
        else
            $scoring->correction = request('correction');
        $scoring->std_id = request('student_id');
        $scoring->lec_id = request('lec_id');
        $scoring->save();
        return redirect('home')->with('alert','successfully submit live scoring');
    }
    
    public function approveDocument(){
        $document = documentUpload::find(request('id'));
        $document->status = 2;
        $document->save();
        if($document->doc_type_name =="Thesis Final Draft"){
            $notification = new notification;
            $notification->message = "Hello, ".$document->student->user->first_name." ".$document->student->user->last_name.". Your final draft document has been approved, please make sure the number of consultation with your lecturer fulfill the minimum consultation sheet.";
            $notification->usr_id =  $document->student->usr_id;
            $notification->save();  
        }
        return redirect()->back()->with('alert','successfully approve document');
    }
    public function disapproveDocument(){
        $document = documentUpload::find(request('id'));
        $document->status = 3;
        $document->findOrFail(request('id'))->delete();
        return redirect()->back()->with('alert','successfully disapprove document');
    }
    public function approveConsultation(){
        $document = proposedConsultation::find(request('id'));
        $document->sts_id = 2;
        $document->save();
        return redirect()->back()->with('alert','successfully approve consultation');
    }
    public function disapproveConsultation(){
        $document = proposedConsultation::find(request('id'));
        $document->sts_id = 3;
        $document->save();
        return redirect()->back()->with('alert','successfully disapprove consultation');
    }
    public function reportLecturer(){
      
        $this->validateLecturer();
        
        $title = count(proposedTitle::where('sts_id','=','2')
                ->where('students.usr_id','=',auth()->id())
                ->join('students','proposed_titles.std_id','=','students.std_id')
                ->get());
        $proposal = count(documentUpload::where('status','=','2')->where('doc_type_name','=','Thesis Proposal')
                ->where('lecturers.usr_id','=',auth()->id())
                ->join('students','document_uploads.std_id','=','students.std_id')
                ->join('lecturers','students.lec_id','=','lecturers.lec_id')
                ->get());
        $interim = count(documentUpload::where('status','=','2')->where('doc_type_name','=','Thesis Interim')
        ->where('lecturers.usr_id','=',auth()->id())
        ->leftJoin('students','document_uploads.std_id','=','students.std_id')
        ->join('lecturers','students.lec_id','=','lecturers.lec_id')
        ->get());
        $finalDraft = count(documentUpload::where('status','=','2')->where('doc_type_name','=','Thesis Final Draft')
        ->where('lecturers.usr_id','=',auth()->id())
                ->leftJoin('students','document_uploads.std_id','=','students.std_id')
                ->join('lecturers','students.lec_id','=','lecturers.lec_id')
                ->get());
            $revisedDoc = count(documentUpload::where('status','=','2')->where('doc_type_name','=','Signed Revised Document')
            ->where('lecturers.usr_id','=',auth()->id())
                ->leftJoin('students','document_uploads.std_id','=','students.std_id')
                ->join('lecturers','students.lec_id','=','lecturers.lec_id')
                ->get());
            $finalDoc = count(documentUpload::where('status','=','2')->where('doc_type_name','=','Finalized Document')
            ->where('lecturers.usr_id','=',auth()->id())
                ->leftJoin('students','document_uploads.std_id','=','students.std_id')
                ->join('lecturers','students.lec_id','=','lecturers.lec_id')
                ->get());

                        $is = count(student::where('major_id','=','1')->where('lec_id',$this->user->lec_id)
                        ->get());
                        $it = count(student::where('major_id','=','2')->where('lec_id',$this->user->lec_id)
                        ->get());
                        $vcd = count(student::where('major_id','=','3')->where('lec_id',$this->user->lec_id)
                        ->get());

            $progress = documentUpload::select('document_uploads.std_id',DB::raw("(CASE WHEN doc_type_name = 'Thesis Proposal' THEN 1
                        WHEN doc_type_name = 'Thesis Interim' THEN 2
                        WHEN doc_type_name = 'Thesis Final Draft' THEN 3
                        WHEN doc_type_name = 'Signed Revised Document' THEN 4
                        WHEN doc_type_name = 'Finalized Document' THEN 5 END) as progress"))->
                    where('status','=','2')
                    ->leftJoin('students','document_uploads.std_id','=','students.std_id')
                    ->join('lecturers','students.lec_id','=','lecturers.lec_id')->orderBy('document_uploads.created_at','DESC')->get()->unique('document_uploads.std_id');

        $students = $this->getStudents();

        return view('lecturer.report',[
            'role' => $this->role,   
            'lecturer' =>lecturer::whereUsrId(auth()->id())->first(),  
                'title' => json_encode($title,JSON_NUMERIC_CHECK),
                'proposal' => json_encode($proposal,JSON_NUMERIC_CHECK),
                'interim' => json_encode($interim,JSON_NUMERIC_CHECK),
                'finalDraft' => json_encode($finalDraft,JSON_NUMERIC_CHECK),
                'revisedDoc' => json_encode($revisedDoc,JSON_NUMERIC_CHECK),
                'finalDoc' => json_encode($finalDoc,JSON_NUMERIC_CHECK),
                'is' => json_encode($is,JSON_NUMERIC_CHECK),
                'it' => json_encode($it,JSON_NUMERIC_CHECK),
                'vcd' => json_encode($vcd,JSON_NUMERIC_CHECK),
                'students' => json_encode($students),
                'progress' => json_encode($progress),
            ]);       
        
    }
}
