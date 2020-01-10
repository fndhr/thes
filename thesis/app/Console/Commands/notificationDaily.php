<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\student;
use App\lecturer;
use App\session;
use App\notification;
use DateTime;
use date;
class notificationDaily extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'command to push daily notification to notification database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $sessions = session::all();
        //session asu
        foreach($sessions as $session){
            $maximumdeadline=strtotime("-3 days");
            if(date($session->title_adv_req_start)<date("Y-m-d") && date("Y-m-d")<date($session->final_draft_end)){
                //masi valid sessionnya
                $flag = 0;
                $message = "";
                if(date($session->title_adv_req_end,$maximumdeadline)<=date("Y-m-d") && date("Y-m-d")<=date($session->title_adv_req_end)){    
                    if((int)date_diff(date_create(),date_create($session->title_adv_req_end))->format("%d") == 0)
                            $duration = "today";
                    else
                        $duration = (int)date_diff(date_create(),date_create($session->title_adv_req_end))->format("%d"). " day(s)";
                    $flag = 1;
                    $message = " The submission for thesis proposal is due in ".$duration.". Please submit your document no longer than ".$session->title_adv_req_end;
                }
                else if(date($session->thesis_proposal_end,$maximumdeadline)<=date("Y-m-d") && date("Y-m-d")<=date($session->thesis_proposal_end)){    
                    if((int)date_diff(date_create(),date_create($session->thesis_proposal_end))->format("%d") == 0)
                        $duration = "today";
                    else
                        $duration = (int)date_diff(date_create(),date_create($session->thesis_proposal_end))->format("%d"). " day(s)";
                    $flag = 2;
                    $message = " The submission for thesis proposal is due in ".$duration.". Please submit your document no longer than ".$session->thesis_proposal_end;
                }
                else if(date($session->interim_report_end,$maximumdeadline)<=date("Y-m-d") && date("Y-m-d")<=date($session->interim_report_end)){    
                    if((int)date_diff(date_create(),date_create($session->interim_report_end))->format("%d") == 0)
                        $duration = "today";
                    else
                        $duration = (int)date_diff(date_create(),date_create($session->interim_report_end))->format("%d"). " day(s)";
                    $flag = 3;
                    $message = " The submission for interim report is due in ".$duration.". Please submit your document no longer than ".$session->interim_report_end;
                }
                else if(date($session->final_draft_end,$maximumdeadline)<=date("Y-m-d") && date("Y-m-d")<=date($session->final_draft_end)){    
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