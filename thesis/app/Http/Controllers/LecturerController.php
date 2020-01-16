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
        if(is_null($this->user)){
            return redirect('home');
        }
        $students = $this->getStudents();
        foreach($students as $student){
            if(!is_null($student->defense)){
                $student->defense->isToday = date('Ymd') == date('Ymd',strtotime($student->defense->date));
                $student->defense->passed = date('Ymd') > date('Ymd',strtotime($student->defense->date));    
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
        $student = student::whereStdId($param)->first();
        $proposedTitle = proposedTitle::whereStdId($param)->whereStsId(2)->first();
        $student->title = $proposedTitle;
        $student->date = date('l, d F Y',strtotime($student->defense->def_strt_dt));
        $student->time = date('h:i:s A',strtotime($student->defense->def_strt_dt)).' - '. date('h:i:s A',strtotime($student->defense->def_end_dt));
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
        
        return view('lecturer.defensescoring',['role' => $this->role,
        'lecturer' => $this->user,'student' => $student]);
    }
    public function studentSearchFilter(Request $request){
        $this->validateLecturer();
        if(is_null($this->user)){
            return redirect('home');
        }
        $nameSearch = request('std_name');
        $fullname = explode(' ',request('std_name'));

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
                $student->defense->isToday = date('Ymd') == date('Ymd',strtotime($student->defense->date));
                $student->defense->passed = date('Ymd') > date('Ymd',strtotime($student->defense->date));    
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
        foreach(request('final_report') as $nilai){
            $totalReport+=$nilai;
        }
        foreach(request('presentation') as $nilai){
            $totalPresentation+=$nilai;
        }
        if(!is_null(request('advisor'))){
            foreach(request('presentation') as $nilai){
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
    
}
