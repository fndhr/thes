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
use App\Page;
use Storage;
use Response;
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
        date_default_timezone_set('Asia/Jakarta');
        $isStudent = count(student::whereUsrId(auth()->id())->get()) == 0 ? false : true;        
        $isLecturer = count(lecturer::whereUsrId(auth()->id())->get())== 0 ? false : true;
        if($isStudent){
            $this->role = 3;
            $student = student::whereUsrId(auth()->id())->first();
            $datetime = explode(' ',$student->session->title_adv_req_end);
            $student->session->passed_adv_title_dt = date('Ymd') > date('Ymd',strtotime($student->session->title_adv_req_end));
            $student->session->title_adv_req_end = $datetime[0];

            $datetime = explode(' ',$student->session->thesis_proposal_end);
            $student->session->passed_proposal_dt = date('Ymd') > date('Ymd',strtotime($student->session->thesis_proposal_end));
            $student->session->thesis_proposal_end = $datetime[0];

            $datetime = explode(' ',$student->session->interim_report_end);
            $student->session->passed_interim_dt = date('Ymd') > date('Ymd',strtotime($student->session->interim_report_end));
            $student->session->interim_report_end = $datetime[0];

            $datetime = explode(' ',$student->session->final_draft_end);
            $student->session->passed_final_draft_dt = date('Ymd') > date('Ymd',strtotime($student->session->final_draft_end));
            $student->session->final_draft_end = $datetime[0];
            
            if(!is_null($student->defense)){
                $datetime = explode(' ',$student->defense->def_strt_dt);
                $date = explode('-',$datetime[0]);
                $time = explode(':',$datetime[1]);
                
                $student->defense->twoWeeksAfter = date('Y-m-d',strtotime($student->defense->def_strt_dt." +2weeks"));
                $student->defense->date = date('l, d F Y',strtotime($student->defense->def_strt_dt));
                $student->defense->time = $time[0].':'.$date[1];
                $student->defense->isToday = date('Ymd') == date('Ymd',strtotime($student->defense->date));
                $student->defense->passed = date('Ymd') > date('Ymd',strtotime($student->defense->date));    
            }
            
            foreach($student->proposedConsultations as $consult){
                $consult->proposed_date = date('d F Y',strtotime($consult->proposed_date));
            }            

            return view('student.studentdashboard',[
                'role' => $this->role,
                'student' => $student,
                'proposedTitle' =>proposedTitle::whereStdId($student->std_id)->get(),
                'lecturers' =>lecturer::whereNotIn('lec_id',proposedAdvisor::whereStdId($student->std_id)->get('lec_id'))->whereIsadv(1)->get(),
                'proposedLecturers' =>proposedAdvisor::whereStdId($student->std_id)->get(),
                'progressUpload' => documentUpload::whereStdId($student->std_id)->orderBy('created_at')->get(),
                'countNotApprovedLecturer' =>count(proposedAdvisor::whereStdId($student->std_id)->whereStsId(1)->get()),
                'countNotApprovedTitle' =>count(proposedTitle::whereStdId($student->std_id)->whereStsId(1)->get()),
            ]);
        }
        else if($isLecturer){
            $this->role = 2;

            return view('lecturer.dashboard',[
                'role' => $this->role,
                'lecturer' =>lecturer::whereUsrId(auth()->id())->first(),     
            ]);
        }
        else{
            $this->role = 1;
                     
            return view('admin.admindashboard',[
                'role'=> $this->role
            ]);
        }   
    }
    
    public function reportAdmin(){

        if(!is_null(User::find(auth()->id())->lecturer) ||!is_null(User::find(auth()->id())->student)){
            return redirect('home');
        }

        $this->role = 1;

        $title = count(proposedTitle::where('sts_id','=','2')->get());
        $proposal = count(documentUpload::where('status','=','2')->where('doc_type_name','=','Thesis Proposal')->get());
        $interim = count(documentUpload::where('status','=','2')->where('doc_type_name','=','Thesis Interim')->get());
        $finalDraft = count(documentUpload::where('status','=','2')->where('doc_type_name','=','Thesis Final Draft')->get());
        $revisedDoc = count(documentUpload::where('status','=','2')->where('doc_type_name','=','Signed Revised Document')->get());
        $finalDoc = count(documentUpload::where('status','=','2')->where('doc_type_name','=','Finalized Document')->get());

        return view('admin.report',[
            'role' => $this->role,
            'title' => json_encode($title,JSON_NUMERIC_CHECK),
            'proposal' => json_encode($proposal,JSON_NUMERIC_CHECK),
            'interim' => json_encode($interim,JSON_NUMERIC_CHECK),
            'finalDraft' => json_encode($finalDraft,JSON_NUMERIC_CHECK),
            'revisedDoc' => json_encode($revisedDoc,JSON_NUMERIC_CHECK),
            'finalDoc' => json_encode($finalDoc,JSON_NUMERIC_CHECK),
        ]);
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

    public function viewFileProposal(Request $request){

        $path = public_path("/uploads//".request('studentId').'//ThesisProposal//'.request('ThesisProposal'));
        $file = request('ThesisProposal');

        return response()->file($path);
    }

    public function viewFileInterim(Request $request){

        $path = public_path("/uploads//".request('studentId').'//ThesisInterim//'.request('ThesisInterim'));
        $file = request('ThesisInterim');

        return response()->file($path);
    }

    public function viewFileFinalDraft(Request $request){

        $path = public_path("/uploads//".request('studentId').'//ThesisFinalDraft//'.request('FinalDraft'));
        $file = request('FinalDraft');

        return response()->file($path);
    }

    public function viewFileFinalizedDoc(Request $request){

        $path = public_path("/uploads//".request('studentId').'//uploadFinalizedDoc//'.request('finalizedDoc'));
        $file = request('finalizedDoc');

        return response()->file($path);
    }

    public function viewFileRevisedDoc(Request $request){

        $path = public_path("/uploads//".request('studentId').'//uploadSignedRevisedDoc//'.request('signedRevisedDoc'));
        $file = request('signedRevisedDoc');

        return response()->file($path);
    }

    public function uploadCsvStudent(Request $request){

        if ($request->input('submit') != null ){
    
          $file = $request->file('file');
    
          // File Details 
          $filename = $file->getClientOriginalName();
          $extension = $file->getClientOriginalExtension();
          $tempPath = $file->getRealPath();
          $fileSize = $file->getSize();
          $mimeType = $file->getMimeType();
    
          // Valid File Extensions
          $valid_extension = array("csv");
    
          // 2MB in Bytes
          $maxFileSize = 2097152; 
    
          // Check file extension
          if(in_array(strtolower($extension),$valid_extension)){
    
            // Check file size
            if($fileSize <= $maxFileSize){
    
              // File upload location
              $location = 'uploads';
    
              // Upload file
              $file->move($location,$filename);
    
              // Import CSV to Database
              $filepath = public_path($location."/".$filename);
    
              // Reading file
              $file = fopen($filepath,"r");
    
              $importData_arr = array();
              $i = 0;
    
              while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                 $num = count($filedata);
                 
                 // Skip first row (Remove below comment if you want to skip the first row)
                 if($i == 0){
                    $i++;
                    continue; 
                 }
                 for ($c=0; $c < $num; $c++) {
                    $importData_arr[$i][] = $filedata [$c];
                 }
                 $i++;
              }
              fclose($file);
        
              // Insert to MySQL database
              foreach($importData_arr as $importData){
    
                $user = new User;
                $user->first_name = $importData[2];
                $user->last_name = $importData[3];
                $user->password = bcrypt($importData[2].$importData[3].'1234');
                $user->email = $importData[0];
                $user->phone = $importData[4];
                $user->save();
                $student = new student;
                $student->std_id = $importData[1];
                $student->usr_id = $user->id;
                $student->major_id = $importData[5];
                $student->session_id = $importData[6];
                $student->save();
              }
    
            }
    
          }
    
        }
    
        // Redirect to index
        return redirect()->back()->with('alert','Successfully Import Student CSV');
      }

      public function uploadCsvLecturer(Request $request){

        if ($request->input('submit') != null ){
    
          $file = $request->file('file');
    
          // File Details 
          $filename = $file->getClientOriginalName();
          $extension = $file->getClientOriginalExtension();
          $tempPath = $file->getRealPath();
          $fileSize = $file->getSize();
          $mimeType = $file->getMimeType();
    
          // Valid File Extensions
          $valid_extension = array("csv");
    
          // 2MB in Bytes
          $maxFileSize = 2097152; 
    
          // Check file extension
          if(in_array(strtolower($extension),$valid_extension)){
    
            // Check file size
            if($fileSize <= $maxFileSize){
    
              // File upload location
              $location = 'uploads';
    
              // Upload file
              $file->move($location,$filename);
    
              // Import CSV to Database
              $filepath = public_path($location."/".$filename);
    
              // Reading file
              $file = fopen($filepath,"r");
    
              $importData_arr = array();
              $i = 0;
    
              while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                 $num = count($filedata);
                 
                 // Skip first row (Remove below comment if you want to skip the first row)
                 if($i == 0){
                    $i++;
                    continue; 
                 }
                 for ($c=0; $c < $num; $c++) {
                    $importData_arr[$i][] = $filedata [$c];
                 }
                 $i++;
              }
              fclose($file);
        
              // Insert to MySQL database
              foreach($importData_arr as $importData){
    
                $user = new User;
                $user->first_name = $importData[2];
                $user->last_name = $importData[3];
                $user->password = bcrypt($importData[2].$importData[3].'1234');
                $user->email = $importData[0];
                $user->phone = $importData[4];
                $user->save();
                $lec = new lecturer;
                $lec->lec_id = $importData[1];
                $lec->usr_id = $user->id;
                $lec->isExm = $importData[5];
                $lec->isAdv = $importData[6];
                $lec->save();
              }
    
            }
    
          }
    
        }
    
        // Redirect to index
        return redirect()->back()->with('alert','Successfully Import Lecturer CSV');
      }
}
