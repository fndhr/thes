<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\lecturer;
use App\student;
use App\proposedAdvisor;
use App\defense;
use App\proposedTitle;
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
        return view('lecturer.studentsearch',[
            'role' => $this->role,
            'students' =>$this->getStudents(),
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
        return view('admin.defensescheduledetail',[
            'role' => $this->role,
            'lecturer' => $this->user,
            'student' => $student
        ]);
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

        return view('lecturer.studentsearch',[
            'role' => $this->role,
            'students' =>student::whereIn('usr_id',$result)->get(),
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
}
