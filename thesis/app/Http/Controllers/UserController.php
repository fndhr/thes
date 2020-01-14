<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use App\User;
use App\student;
use App\lecturer;
use App\session;
use App\notification;

class UserController extends Controller
{
    public function studentRegister(Request $request){
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'std_id' => 'required|string|unique:students',
            'phone' => request('phone') != null ? 'min:10|regex:/(08)[0-9]{9}/' : '',
            'email' => 'required|email|unique:users',
            'session_id'=>'required'
        ]);
        if ($validator->fails()) {
            $validator->validate();
        }
        $user = new User;
        $user->password = bcrypt(request('first_name').request('last_name').'1234');
        $user->first_name = request('first_name');
        $user->last_name = request('last_name'); 
        $user->email = request('email');
        $user->phone = request('phone');
        $user->save();
        $student = new student;
        $student->std_id = request('std_id');
        $student->usr_id = $user->id;
        $student->major_id = request('major_id');
        $student->session_id = request('session_id');
        $student->save();
		return redirect()->back()->with('alert','Successfully Add Student');
    }

    public function lecturerRegister(Request $request){
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'lec_id' => 'required|unique:lecturers',
            'phone' =>  request('phone') != null ? 'min:10|regex:/(08)[0-9]{9}/' : '',
            'email' => 'required|email|unique:users',
        ]);
        if ($validator->fails()) {
            $validator->validate();
        }
        $user = new User;
        $user->password = bcrypt(request('first_name').request('last_name').'1234');
        $user->first_name = request('first_name');
        $user->last_name = request('last_name'); 
        $user->email = request('email');
        $user->phone = request('phone');
        $user->save();
        $lec = new lecturer;
        $lec->lec_id = request('lec_id');
        $lec->usr_id = $user->id;
        if(!is_null($request->input('isExm'))){
            $lec->isExm = 1;
        }
        if(!is_null($request->input('isAdv'))){
            $lec->isAdv = 1;
        }
        $lec->save();
		return redirect()->back()->with('alert','Successfully Add Lecturer');
    }    

    public function notif(){
        
        $sessions = session::all();
        //session asu
        foreach($sessions as $session){
            $maximumdeadline=" -3 days";
            if(date($session->title_adv_req_start)<date("Y-m-d") && date("Y-m-d")<date($session->final_draft_end)){
                //masi valid sessionnya
                $flag = 0;
                $message = "";
                if(date("Y-m-d",strtotime($session->title_adv_req_end.$maximumdeadline))<=date("Y-m-d") && date("Y-m-d")<=date("Y-m-d",strtotime($session->title_adv_req_end))){    
                    if((int)date_diff(date_create(),date_create($session->title_adv_req_end))->format("%d") == 0)
                            $duration = "today";
                    else
                        $duration = (int)date_diff(date_create(),date_create($session->title_adv_req_end))->format("%d"). " day(s)";
                    $flag = 1;
                    $message = " The submission for thesis proposal is due in ".$duration.". Please submit your document no longer than ".$session->title_adv_req_end;
                }
                else if(date("Y-m-d",strtotime($session->thesis_proposal_end.$maximumdeadline))<=date("Y-m-d") && date("Y-m-d")<=date($session->thesis_proposal_end)){    
                    if((int)date_diff(date_create(),date_create($session->thesis_proposal_end))->format("%d") == 0)
                        $duration = "today";
                    else
                        $duration = (int)date_diff(date_create(),date_create($session->thesis_proposal_end))->format("%d"). " day(s)";
                    $flag = 2;
                    $message = " The submission for thesis proposal is due in ".$duration.". Please submit your document no longer than ".$session->thesis_proposal_end;
                }
                else if(date("Y-m-d",strtotime($session->interim_report_end.$maximumdeadline))<=date("Y-m-d") && date("Y-m-d")<=date($session->interim_report_end)){    
                    if((int)date_diff(date_create(),date_create($session->interim_report_end))->format("%d") == 0)
                        $duration = "today";
                    else
                        $duration = (int)date_diff(date_create(),date_create($session->interim_report_end))->format("%d"). " day(s)";
                    $flag = 3;
                    $message = " The submission for interim report is due in ".$duration.". Please submit your document no longer than ".$session->interim_report_end;
                }
                else if(date("Y-m-d",strtotime($session->final_draft_end.$maximumdeadline))<=date("Y-m-d") && date("Y-m-d")<=date($session->final_draft_end)){    
                    if((int)date_diff(date_create(),date_create($session->final_draft_end))->format("%d") == 0)    
                        $duration = "today";
                    else
                        $duration = (int)date_diff(date_create(),date_create($session->final_draft_end))->format("%d"). " days";
                    $flag = 4;      
                    $message = " The submission for final draft is due in ".$duration.". Please submit your document no longer than ".$session->final_draft_end;
                }
                if($flag != 0){
                    $lec_id = [];
                    foreach($session->students as $student){
                        if($flag == 1){
                            if(count(propossedTitle::whereStdId($student->std_id)->whereStsId(2)->get())==0){
                                $notification = new notification;
                                $notification->message = "Hello, ".$student->user->first_name." ".$student->user->last_name.".".$message;
                                $notification->save();
                            }
                        }
                        else{
                            if(count($student->documentUpload) <= ($flag-1)){
                                $notification = new notification;
                                $notification->message = "Hello, ".$student->user->first_name." ".$student->user->last_name.".".$message;
                                $notification->usr_id = $student->usr_id;
                                $notification->save();
                            }
                        }
                        array_push($lec_id,$student->lec_id);
                    }
                    foreach(lecturer::whereIn('lec_id',$lec_id)->get() as $lecturer){
                        if($flag!=1){
                            $messages = explode('.',$message);
                            $notification = new notification;
                            $notification->message = "Hello, ".$lecturer->user->first_name." ".$lecturer->user->last_name.".".$messages[0].". Please make sure that your students have submitted.";
                            $notification->usr_id = $lecturer->usr_id;
                            $notification->save();
                        }
                    }
                }
            }
        }
    }
}
