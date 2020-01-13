<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\proposedTitle;
use App\proposedAdvisor;
use App\student;
use App\documentUpload;
use Validator;
class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');   
    }
	public function submitTitle(Request $request){
		$validator = Validator::make($request->all(), [
            'title_name' => 'required',
        ]);
        if ($validator->fails()) {
            $validator->validate();
		}
		$student = student::whereUsrId(auth()->id())->first();
		$title = new proposedTitle;
		$title->title_name = request('title_name');
		$title->std_id = $student->std_id;
		$title->save();
		return redirect()->back()->with('alert','Successfully Submit Title');
	}

	
	public function submitAdvisor(Request $request){
		
		$validator = Validator::make($request->all(), [
            'advisor' => 'required',
        ]);
        if ($validator->fails()) {
            $validator->validate();
		}
		$student = student::whereUsrId(auth()->id())->first();
		$adv = new proposedAdvisor;
		$adv->lec_id = request('advisor');
		$adv->std_id = $student->std_id;
		$adv->save();
		return redirect()->back()->with('alert','Successfully Submit Advisor');
	}

	public function uploadDocThesisProposal(Request $request){			

		$validation = $request->validate([
			'file' => 'required|file|mimes:pdf,zip'
		]);

		if($request->has('file')){
			
			$student = student::whereUsrId(auth()->id())->first();

			$file = $request->file('file');
			$fileName = $file->getClientOriginalName();
			$file->move('uploads\\'.$student->std_id.'\ThesisProposal',$file->getClientOriginalName());

			//$temp = file_get_contents($file);
			//$blob = base64_encode($temp);

			$uploadDoc = new documentUpload;
			$uploadDoc->std_id = $student->std_id;
			$uploadDoc->doc_name = $fileName;
			$uploadDoc->doc_type_name = 'Thesis Proposal';
			
			$uploadDoc->save();
			$notification = new notification;
			$notification->message = $student->user->first_name." ".$student->user->last_name." has submitted their .".$uploadDoc->doc_type_name;
			$notification->usr_id =  $student->lecturer->usr_id;
			$notification->save();
			return redirect()->back()->with('alert','Successfully Submit Document');
		}
	}

	public function uploadDocThesisInterim(Request $request){			

		$validation = $request->validate([
			'file' => 'required|file|mimes:pdf,zip'
		]);

		if($request->has('file')){
			$student = student::whereUsrId(auth()->id())->first();

			$file = $request->file('file');
			$fileName = $file->getClientOriginalName();
			$file->move('uploads\\'.$student->std_id.'\ThesisInterim',$file->getClientOriginalName());

			// $path = $request->file('file')->store('file',$fileName);
			// $size = $file->getSize();

			$uploadDoc = new documentUpload;
			$uploadDoc->std_id = $student->std_id;
			$uploadDoc->doc_name = $fileName;
			$uploadDoc->doc_type_name = 'Thesis Interim';
			
			$uploadDoc->save();
			$notification = new notification;
			$notification->message = $student->user->first_name." ".$student->user->last_name." has submitted their .".$uploadDoc->doc_type_name;
			$notification->usr_id =  $student->lecturer->usr_id;
			$notification->save();
			return redirect()->back()->with('alert','Successfully Submit Document');
		}
	}

	public function uploadDocThesisFinalDraft(Request $request){			

		$validation = $request->validate([
			'file' => 'required|file|mimes:pdf,zip'
		]);

		if($request->has('file')){
			$student = student::whereUsrId(auth()->id())->first();

			$file = $request->file('file');
			$fileName = $file->getClientOriginalName();
			$file->move('uploads\\'.$student->std_id.'\ThesisFinalDraft',$file->getClientOriginalName());
			// $path = $request->file('file')->store('file',$fileName);
			// $size = $file->getSize();

			$uploadDoc = new documentUpload;
			$uploadDoc->std_id = $student->std_id;
			$uploadDoc->doc_name = $fileName;
			$uploadDoc->doc_type_name = 'Thesis Final Draft';
			
			$uploadDoc->save();
			$notification = new notification;
			$notification->message = $student->user->first_name." ".$student->user->last_name." has submitted their .".$uploadDoc->doc_type_name;
			$notification->usr_id =  $student->lecturer->usr_id;
			$notification->save();
			return redirect()->back()->with('alert','Successfull Submit Document');
		}
	}

	public function checkIsProposalSubmitted(){
		
	}

	public function uploadSignedRevisedDoc(Request $request){			

		$validation = $request->validate([
			'file' => 'required|file|mimes:pdf,zip'
		]);

		if($request->has('file')){
			$student = student::whereUsrId(auth()->id())->first();

			$file = $request->file('file');
			$fileName = $file->getClientOriginalName();
			$file->move('uploads\\'.$student->std_id.'\uploadSignedRevisedDoc',$file->getClientOriginalName());


			$uploadDoc = new documentUpload;
			$uploadDoc->std_id = $student->std_id;
			$uploadDoc->doc_name = $fileName;
			$uploadDoc->doc_type_name = 'Signed Revised Document';
			
			$uploadDoc->save();
			
			$notification = new notification;
			$notification->message = $student->user->first_name." ".$student->user->last_name." has submitted their .".$uploadDoc->doc_type_name;
			$notification->usr_id =  $student->lecturer->usr_id;
			$notification->save();
			return redirect()->back()->with('alert','Successfull Submit Document');
		}
	}

	public function uploadFinalizedDoc(Request $request){			

		$validation = $request->validate([
			'file' => 'required|file|mimes:pdf,zip'
		]);

		if($request->has('file')){
			$student = student::whereUsrId(auth()->id())->first();

			$file = $request->file('file');
			$fileName = $file->getClientOriginalName();
			$file->move('uploads\\'.$student->std_id.'\uploadFinalizedDoc',$file->getClientOriginalName());


			$uploadDoc = new documentUpload;
			$uploadDoc->std_id = $student->std_id;
			$uploadDoc->doc_name = $fileName;
			$uploadDoc->doc_type_name = 'Finalized Document';
			
			$uploadDoc->save();


			$notification = new notification;
			$notification->message = $student->user->first_name." ".$student->user->last_name." has submitted their .".$uploadDoc->doc_type_name;
			$notification->usr_id =  $student->lecturer->usr_id;
			$notification->save();
			return redirect()->back()->with('alert','Successfull Submit Document');
		}
	}
}