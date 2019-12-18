<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\proposedTitle;
use App\proposedAdvisor;
use App\student;
use Validator;
class StudentController extends Controller
{
    //
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
}