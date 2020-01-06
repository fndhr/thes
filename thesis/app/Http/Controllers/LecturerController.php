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
        return student::paginate(20);
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
        $defenses = defense::whereDate('def_strt_dt','>=',date('Y-m-d'))->get();
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

        $result = User::where('users.first_name','LIKE','%'.$nameSearch.'%')
                    ->orWhere('users.last_name','LIKE','%'.$nameSearch.'%')
                    ->orWhere('students.std_id','LIKE','%'.$nameSearch.'%')
                    ->orWhereIn('users.first_name',$fullname)->orWhereIn('users.last_name',$fullname)
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

        $defenses = defense::where('defenses.std_id','LIKE','%'.$inputSearch.'%')
                            ->orWhere('users.first_name','LIKE','%'.$inputSearch.'%')
                            ->orWhere('users.last_name','LIKE','%'.$inputSearch.'%')
                            ->orWhereIn('users.first_name',$fullname)->orWhereIn('users.last_name',$fullname)
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
