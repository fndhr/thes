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
		return redirect()->back()->with('alert','successfull submit title');
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
		return redirect()->back()->with('alert','successfull submit advisor');
	}

	public function uploadDocThesisProposal(Request $request){			

		if($request->has('file')){
			
			$student = student::whereUsrId(auth()->id())->first();

			$file = $request->file('file');
			$fileName = $file->getClientOriginalName();
			//$file->move('uploads\\'.$student->std_id.'\ThesisProposal',$file->getClientOriginalName());
			$temp = file_get_contents($file);
			$blob = base64_encode($temp);

			$uploadDoc = new documentUpload;
			$uploadDoc->std_id = $student->std_id;
			$uploadDoc->doc_name = $blob;
			$uploadDoc->doc_type_name = 'Thesis Proposal';
			
			$uploadDoc->save();
			return redirect()->back()->with('alert','successfull submit document');
		}
	}

	public function uploadDocThesisInterim(Request $request){			

		if($request->has('file')){
			$student = student::whereUsrId(auth()->id())->first();

			$file = $request->file('file');
			$fileName = $file->getClientOriginalName();
			//$file->move('uploads\ThesisInterim',$file->getClientOriginalName());
			// $path = $request->file('file')->store('file',$fileName);
			// $size = $file->getSize();

			$uploadDoc = new documentUpload;
			$uploadDoc->std_id = $student->std_id;
			$uploadDoc->doc_name = $fileName;
			$uploadDoc->doc_type_name = 'Thesis Interim';
			
			$uploadDoc->save();
			return redirect()->back()->with('alert','successfull submit document');
		}
	}

	public function uploadDocThesisFinalDraft(Request $request){			

		if($request->has('file')){
			$student = student::whereUsrId(auth()->id())->first();

			$file = $request->file('file');
			$fileName = $file->getClientOriginalName();
			//$file->move('uploads\ThesisFinalDraft',$file->getClientOriginalName());
			// $path = $request->file('file')->store('file',$fileName);
			// $size = $file->getSize();

			$uploadDoc = new documentUpload;
			$uploadDoc->std_id = $student->std_id;
			$uploadDoc->doc_name = $fileName;
			$uploadDoc->doc_type_name = 'Thesis Final Draft';
			
			$uploadDoc->save();
			return redirect()->back()->with('alert','successfull submit document');
		}
	}

	public function checkIsProposalSubmitted(){
		
	}
}