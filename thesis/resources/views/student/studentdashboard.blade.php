@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row my-4">
        <div class="col-12 text-center">
            <h1>Student Dashboard</h1>
        </div>
    </div>
    <div class="accordion mx-3" id="accordionExample">
        <div class="card">
            <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                <h4 class="text-black">Your Progress</h4>
            </div>
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                    <div class="row py-2">
                        <div class="col-3">Title</div>
                        <div class="col-9">:&nbsp;&nbsp;
                            @php($title_name = NULL)
                            @foreach($proposedTitle as $title)
                                @if($title->sts_id == 2)
                                    @php($title_name = $title->title_name)
                                @endif
                            @endforeach
                            {{$title_name ?? '-'}}
                        </div>
                    </div>
                    <div class="row py-2">
                        <div class="col-3">Advisor</div>
                        <div class="col-9">:&nbsp;&nbsp;
                            {{$student->lecturer ? $student->lecturer->user->first_name.' '.$student->lecturer->user->last_name : '-'}}
                        </div>
                    </div>
                    <div class="row py-2">
                        <div class="col-3">Status</div>
                        <div class="col-9">:&nbsp;&nbsp;
                            @if(is_null($student->lecturer) || is_null($title_name))
                                @if(is_null($student->lecturer))
                                    Lecturer
                                @endif
                                @if(is_null($student->lecturer) && is_null($title_name))
                                    and Title
                                @elseif(is_null($title_name))
                                    Title
                                @endif
                                Hasn't been Set
                            @elseif(count($progressUpload)==0)
                                Proposal Document has not been Uploaded
                            @elseif(count($progressUpload)==1)
                                Interim has not been Uploaded
                            @elseif(count($progressUpload)==2)
                                Final Draft has not been Uploaded
                            @elseif(count($progressUpload)==3 && is_null($student->defense))
                                Waiting for Defense Date
                            @elseif(count($progressUpload)==3 && !is_null($student->defense))
                                @if($student->defense->passed)
                                    Revised Documents has not been Uploaded
                                @elseif($student->defense->isToday)
                                    Today is the Defense Date
                                @else
                                    Waiting for Defense Date
                                @endif
                            @elseif(count($progressUpload)==4)
                                Finalized document has not been Uploaded
                            @else
                                Finished
                            @endif
                        </div>
                    </div>
                    <div class="row py-2">
                        <div class="col-3">Defense Date</div>
                        <div class="col-9">:&nbsp;&nbsp;
                            {{$student->defense ? $student->defense->date.' '.$student->defense->time : 'Date Not Yet Set' }}

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="card">
            <div class="card-header" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                <h4 class="text-black">Title and Advisor Proposal</h4>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                <div class="card-body">
                    <div class="row my-4 text-center bg-light mx-5 session">
                        <div class="col-4 pt-2"><h5>Session</h5></div>
                        <div class="col-4 pt-2"><h5>Deadline: {{$student->session->title_adv_req_end ?? '-'}}</h5></div>
                        <div class="col-4 pt-2"><h5>Status: null</h5></div>
                    </div>
                    <div class="px-4">
                        <form class="mt-5 mb-3 submitForm" action="" method="">
                            <div class="form-group row">
                                <label class="col-3 col-form-label inputRequired">Title 1*</label>
                                <input type="text" class="form-control col-9" for="title_name1" name="title_name1" placeholder="Title Name 1">
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">Title 2</label>
                                <input type="text" class="form-control col-9" for="title_name2" name="title_name2" placeholder="Title Name 2">
                            </div>
                            <div class="form-group row">
                                <label class="col-3 col-form-label">Title 3</label>
                                <input type="text" class="form-control col-9" for="title_name3" name="title_name3" placeholder="Title Name 3">
                            </div>
                            <div class="form-group row">
                                <label for="majorStudent" class="col-3 col-form-label inputRequired">Advisor 1*</label>
                                <select class="form-control col-4 @error('advisor1') is-invalid @enderror" for="advisor1" name="advisor1">
                                    <option value="">Choose...</option>
                                    @foreach($lecturers as $lecturer)
                                        <option value="{{$lecturer->lec_id}}">{{$lecturer->user->first_name}} {{$lecturer->user->last_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group row">
                                <label for="majorStudent" class="col-3 col-form-label">Advisor 2</label>
                                <select class="form-control col-4 @error('advisor2') is-invalid @enderror" for="advisor2" name="advisor2">
                                    <option value="">Choose...</option>
                                    @foreach($lecturers as $lecturer)
                                        <option value="{{$lecturer->lec_id}}">{{$lecturer->user->first_name}} {{$lecturer->user->last_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group row">
                                <label for="majorStudent" class="col-3 col-form-label">Advisor 3</label>
                                <select class="form-control col-4 @error('advisor3') is-invalid @enderror" for="advisor3" name="advisor3">
                                    <option value="">Choose...</option>
                                    @foreach($lecturers as $lecturer)
                                        <option value="{{$lecturer->lec_id}}">{{$lecturer->user->first_name}} {{$lecturer->user->last_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success btn-pill px-5 my-3 btnSubmit">Submit</button>
                            </div>
                        </form>
                        <!-- @if(is_null($title_name)&&$countNotApprovedTitle < 3)
                        <form class="mt-5 mb-3 submitForm" action="/student/submitTitle" method="POST">
                            @csrf
                            <div class="form-group row">
                                <label class="col-3 col-form-label">Title</label>
                                <input type="text" class="form-control col-9" for="title_name" name="title_name" placeholder="Title Name">
                            </div>
                            @if($student->session->passed_adv_title_dt)
                                <div class="text-center">
                                    <button type="submit" class="btn btn-secondary px-5 my-3 btnSubmitTitle" disabled>Submit</button>
                                </div>
                            @else
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success px-5 my-3 btnSubmitTitle">Submit</button>
                                </div>
                            @endif                            
                        </form>
                        @endif
                        @if(count($proposedTitle)>0)
                        <div class="py-3">
                            <table class="table table-sm table-bordered table-hover">
                                <thead class="thead-dark text-center">
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for($counter = 0 ; $counter < count($proposedTitle) ;$counter++)
                                    <tr>
                                        <td>{{$counter+1}}.</td>
                                        <td>{{$proposedTitle[$counter]->title_name}}</td>
                                        <td>{{$proposedTitle[$counter]->statuses->sts_name}}</td>
                                    </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>
                        @endif
                        @if(is_null($student->lecturer)&&$countNotApprovedLecturer < 3)
                        <form class="mt-5 mb-3 submitForm" action="/student/submitAdvisor" method="POST">
                            @csrf
                            <div class="form-group row">
                                <label for="majorStudent" class="col-3 col-form-label">Advisor</label>
                                <select class="form-control col-9 @error('advisor') is-invalid @enderror" for="advisor" name="advisor">
                                    <option value="">Choose...</option>
                                    @foreach($lecturers as $lecturer)
                                        <option value="{{$lecturer->lec_id}}">{{$lecturer->user->first_name}} {{$lecturer->user->last_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-3"></div>
                                <div class="col-9 px-0">
                                    @error('advisor')
                                        <span class="invalid-feedback" role="alert" style="display:block; margin-top: -10px;">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success px-5 my-3 btnSubmit">Submit</button>
                            </div>
                        </form>
                        @endif
                        @if(count($proposedLecturers)>0)
                        <div class="py-3">
                            <table class="table table-sm table-bordered table-hover">
                                <thead class="thead-dark text-center">
                                    <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Advisor</th>
                                    <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for($counter = 0 ; $counter < count($proposedLecturers) ;$counter++)
                                    <tr>
                                        <td>{{$counter+1}}.</td>
                                        <td>{{$proposedLecturers[$counter]->lecturer->user->first_name}} {{$proposedLecturers[$counter]->lecturer->user->last_name}}</td>
                                        <td>{{$proposedLecturers[$counter]->statuses->sts_name}}</td>
                                    </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>
                        @endif -->
                    </div>
                </div>
            </div>
        </div>


        <div class="card">
        @if(is_null($student->lecturer))
            <div class="card-header" id="headingThree" data-toggle="no-collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                <h4>Upload Your Signed Thesis Proposal</h4>
            </div>
        @else
            <div class="card-header" id="headingThree" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                <h4 class="text-black">Upload Your Signed Thesis Proposal</h4>
            </div>
        @endif
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                <div class="card-body">
                    <div class="row my-4 text-center bg-light mx-5 session">
                        <div class="col-4 pt-2"><h5>Session</h5></div>
                        <div class="col-4 pt-2"><h5>Deadline: {{$student->session->thesis_proposal_end ?? '-'}}</h5></div>
                        <div class="col-4 pt-2"><h5>Status: null</h5></div>
                    </div>
                    <div class="row py-2">
                        <div class="col-3">Title</div>
                        <div class="col-9">:&nbsp;&nbsp;{{$title_name ?? '-'}}</div>
                    </div>
                    <div class="row py-2">
                        <div class="col-3">Advisor</div>
                        <div class="col-9">:&nbsp;&nbsp;{{$student->lecturer ?$student->lecturer->user->first_name.' '.$student->lecturer->user->last_name : '-'}}</div>
                    </div>
                    <div class="row py-2">
                        <div class="col-3">File Submmited</div>
                        <div class="col-9">:&nbsp;
                        @if(count($student->documentUpload)>=1)
                            {{$student->documentUpload[0]->doc_name}}
                        @else
                            -
                        @endif    
                        </div>
                    </div>
                    <div class="row py-2">
                        <div class="col-12 text-center">
                            <form class="text-center submitForm" action="/student/uploadDocThesisProposal" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                                <div class="form-group row justify-content-center">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="file" class="col-3 form-control-file" id="file" for="file" name="file">
                                </div>
                                @error('file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                @if($student->session->passed_proposal_dt || count($student->documentUpload)>=1)
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-secondary btn-pill px-5 my-3 btnSubmitProposal" disabled>Submit</button>
                                    </div>
                                @else
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success btn-pill px-5 my-3 btnSubmitProposal">Submit</button>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                    <div class="row py-2">
                        <div class="col text-danger">*Please note that you only have 1 attempt to upload the file</div>
                    </div>
                </div>
            </div>
        </div>


        <div class="card">
        @if(count($student->documentUpload)>=1)
            <div class="card-header" id="headingFour" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                <h4 class="text-black">Upload Your Signed Interim Report</h4>
        @else
            <div class="card-header" id="headingFour" data-toggle="no-collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                <h4>Upload Your Signed Interim Report</h4>
        @endif   
            </div>
            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                <div class="card-body">
                    <div class="row my-4 text-center bg-light mx-5 session">
                        <div class="col-4 pt-2"><h5>Session</h5></div>
                        <div class="col-4 pt-2"><h5>Deadline: {{$student->session->interim_report_end ?? '-'}}</h5></div>
                        <div class="col-4 pt-2"><h5>Status: null</h5></div>
                    </div>
                    <div class="row py-2">
                        <div class="col-3">Title</div>
                        <div class="col-9">:&nbsp;&nbsp;{{$title_name ?? '-'}}</div>
                    </div>
                    <div class="row py-2">
                        <div class="col-3">Advisor</div>
                        <div class="col-9">:&nbsp;&nbsp;{{$student->lecturer ?$student->lecturer->user->first_name.' '.$student->lecturer->user->last_name : '-'}}</div>
                    </div>
                    <div class="row py-2">
                        <div class="col-3">File Submmited</div>
                        <div class="col-9">:&nbsp;
                        @if(count($student->documentUpload)>=2)
                            {{$student->documentUpload[1]->doc_name}}
                        @else
                            -
                        @endif
                        </div>
                    </div>
                    <div class="row py-2">
                        <div class="col-12 text-center">
                        <form class="text-center submitForm" action="/student/uploadDocThesisInterim" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                                <div class="form-group row justify-content-center">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="file" class="col-3 form-control-file" id="file" for="file" name="file">
                                </div>
                                @if($student->session->passed_interim_dt || count($student->documentUpload)>=2)
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-secondary btn-pill px-5 my-3 btnSubmitInterim" disabled>Submit</button>
                                    </div>
                                @else
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success btn-pill px-5 my-3 btnSubmitInterim">Submit</button>
                                    </div>
                                @endif
                                
                            </form>
                        </div>
                    </div>
                    <div class="row py-2">
                        <div class="col text-danger">*Please note that you only have 1 attempt to upload the file</div>
                    </div>
                </div>
            </div>
        </div>


        <div class="card">
        @if(count($student->documentUpload)>=2)
            <div class="card-header" id="headingFive" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                <h4 class="text-black">Upload Your Signed Final Draft</h4>
        @else
            <div class="card-header" id="headingFive" data-toggle="no-collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                <h4>Upload Your Signed Final Draft</h4>
        @endif
            </div>
            <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                <div class="card-body">
                    <div class="row my-4 text-center bg-light mx-5 session">
                        <div class="col-4 pt-2"><h5>Session</h5></div>
                        <div class="col-4 pt-2"><h5>Deadline: {{$student->session->final_draft_end ?? '-'}}</h5></div>
                        <div class="col-4 pt-2"><h5>Status: null</h5></div>
                    </div>
                    <div class="row py-2">
                        <div class="col-3">Title</div>
                        <div class="col-9">:&nbsp;&nbsp;{{$title_name ?? '-'}}</div>
                    </div>
                    <div class="row py-2">
                        <div class="col-3">Advisor</div>
                        <div class="col-9">:&nbsp;&nbsp;{{$student->lecturer ?$student->lecturer->user->first_name.' '.$student->lecturer->user->last_name : '-'}}</div>
                    </div>
                    <div class="row py-2">
                        <div class="col-3">File Submmited</div>
                        <div class="col-9">:&nbsp;
                        @if(count($student->documentUpload)>=3)
                            {{$student->documentUpload[2]->doc_name}}
                        @else
                            -
                        @endif
                        </div>
                    </div>
                    <div class="row py-2">
                        <div class="col-12 text-center">
                        <form class="text-center submitForm" action="/student/uploadDocThesisFinalDraft" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                                <div class="form-group row justify-content-center">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="file" class="col-3 form-control-file" id="file" for="file" name="file">
                                </div>
                                @if($student->session->passed_final_draft_dt || count($student->documentUpload)>=3)
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-secondary btn-pill px-5 my-3 btnSubmitFinalDraft" disabled>Submit</button>
                                    </div>
                                @else
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success btn-pill px-5 my-3 btnSubmitFinalDraft">Submit</button>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                    <div class="row py-2">
                        <div class="col text-danger">*Please note that you only have 1 attempt to upload the file</div>
                    </div>
                </div>
            </div>
        </div>


        <div class="card">
        @if(count($student->documentUpload)>=2)
            <div class="card-header" id="headingSix" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                <h4 class="text-black">Your Defense Schedule</h4>
        @else
            <div class="card-header" id="headingSix" data-toggle="no-collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                <h4>Your Defense Schedule</h4>
        @endif
            </div>
            <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
                <div class="card-body">
                    <div class="row py-2">
                        <div class="col-3">Title</div>
                        <div class="col-9">:&nbsp;&nbsp;{{$title_name ?? '-'}}</div>
                    </div>
                    <div class="row py-2">
                        <div class="col-3">Advisor</div>
                        <div class="col-9">:&nbsp;&nbsp;{{$student->lecturer ? $student->lecturer->user->first_name.' '.$student->lecturer->user->last_name : '-'}}</div>
                    </div>
                    <div class="row py-2">
                        <div class="col-3">Date</div>
                        <div class="col-9">:&nbsp;&nbsp;{{$student->defense ? $student->defense->date : '-'}}</div>
                    </div>
                    <div class="row py-2">
                        <div class="col-3">Time</div>
                        <div class="col-9">:&nbsp;&nbsp;{{$student->defense ? $student->defense->time : '-'}}</div>
                    </div>
                    <div class="row py-2">
                        <div class="col-3">Room</div>
                        <div class="col-9">:&nbsp;&nbsp;{{$student->defense ? $student->defense->room : '-'}}</div>
                    </div>
                    <div class="row py-2">
                        <div class="col-3">Chairman</div>
                        <div class="col-9">:&nbsp;&nbsp;{{$student->defense ? $student->defense->chairman_name->user->first_name.' '.$student->defense->chairman_name->user->last_name : '-'}}</div>
                    </div>
                    <div class="row py-2">
                        <div class="col-3">Examiner</div>
                        <div class="col-9">:&nbsp;&nbsp;{{$student->defense ? $student->defense->examiner_name->user->first_name.' '.$student->defense->examiner_name->user->last_name : '-'}}</div>
                    </div>
                </div>
            </div>
        </div>


        <div class="card">
        @if(!is_null($student->defense))
            @if($student->defense->passed)
            <div class="card-header" id="headingSeven" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                <h4 class="text-black">Upload Your Signed Revised Document</h4>
            @else
            <div class="card-header" id="headingSeven" data-toggle="no-collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                <h4>Upload Your Signed Revised Document</h4>
            @endif
        @else
            <div class="card-header" id="headingSeven" data-toggle="no-collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                <h4>Upload Your Signed Revised Document</h4>
        @endif
            </div>
            <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordionExample">
                <div class="card-body">
                    <div class="row my-4 text-center bg-light mx-5 session">
                        <div class="col-4 pt-2"><h5>Session</h5></div>
                        <div class="col-4 pt-2"><h5>Deadline: {{$student->session->final_revised_document ?? '-'}}</h5></div>
                        <div class="col-4 pt-2"><h5>Status: null</h5></div>
                    </div>
                    <div class="row py-2">
                        <div class="col-3">Title</div>
                        <div class="col-9">:&nbsp;&nbsp;{{$title_name ?? '-'}}</div>
                    </div>
                    <div class="row py-2">
                        <div class="col-3">Advisor</div>
                        <div class="col-9">:&nbsp;&nbsp;{{$student->lecturer ?$student->lecturer->user->first_name.' '.$student->lecturer->user->last_name : '-'}}</div>
                    </div>
                    <div class="row py-2">
                        <div class="col-3">File Submmited</div>
                        <div class="col-9">:&nbsp;&nbsp;-</div>
                    </div>
                    <div class="row py-2">
                        <div class="col-12 text-center">
                            <form class="text-center submitForm" action="/student/uploadSignedRevisedDoc" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                                <div class="form-group row justify-content-center">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="file" class="col-3 form-control-file" id="file" for="file" name="file">
                                </div>
                                @if($student->session->passed_revised_doc_dt || count($student->documentUpload)>=4)
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-secondary btn-pill px-5 my-3 btnSubmitRevisedDoc" disabled>Submit</button>
                                    </div>
                                @else
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success btn-pill px-5 my-3 btnSubmitRevisedDoc">Submit</button>
                                    </div>
                                @endif                                
                            </form>
                        </div>
                    </div>
                    <div class="row py-2">
                        <div class="col text-danger">*Please note that you only have 1 attempt to upload the file</div>
                    </div>
                </div>
            </div>
        </div>


        <div class="card">
        @if(!is_null($student->defense))
            @if($student->defense->passed)
            <div class="card-header" id="headingEight" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                <h4 class="text-black">Upload Your Finalized Documents</h4>
            @else
            <div class="card-header" id="headingEight" data-toggle="no-collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                <h4>Upload Your Finalized Documents</h4>
            @endif
        @else
            <div class="card-header" id="headingEight" data-toggle="no-collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                <h4>Upload Your Finalized Documents</h4>
        @endif
            </div>
            <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordionExample">
                <div class="card-body">
                    <div class="row my-4 text-center bg-light mx-5 session">
                        <div class="col-4 pt-2"><h5>Session</h5></div>
                        <div class="col-4 pt-2"><h5>Deadline: {{$student->session->final_finalized_document ?? '-'}}</h5></div>
                        <div class="col-4 pt-2"><h5>Status: null</h5></div>
                    </div>
                    <div class="row py-2">
                        <div class="col-3">Title</div>
                        <div class="col-9">:&nbsp;&nbsp;{{$title_name ?? '-'}}</div>
                    </div>
                    <div class="row py-2">
                        <div class="col-3">Advisor</div>
                        <div class="col-9">:&nbsp;&nbsp;{{$student->lecturer ?$student->lecturer->user->first_name.' '.$student->lecturer->user->last_name : '-'}}</div>
                    </div>

                    <div class="row py-2">
                        <div class="col-3">Source code</div>
                        <div class="col-9">:&nbsp;&nbsp;-</div>
                    </div>
                    <div class="row py-2">
                        <div class="col-12 text-center">
                            <form class="text-center submitForm" action="/student/uploadFinalizedDoc" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                                <div class="form-group row justify-content-center">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="file" class="col-3 form-control-file" id="file" for="file" name="file">
                                </div>
                                @if($student->session->passed_finalized_doc_dt || count($student->documentUpload)>=5)
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-secondary btn-pill px-5 my-3 btnSubmitFinalized" disabled>Submit</button>
                                    </div>
                                @else
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success btn-pill px-5 my-3 btnSubmitFinalized">Submit</button>
                                    </div>
                                @endif                                
                            </form>
                        </div>
                    </div>
                    <br />
                    <div class="text-danger">*Please note that you only have 1 attempt to upload the file</div>
                    <div class="text-danger">*Make Sure to Get 3 Signatures from <strong>Thesis Advisor, Head Study Program, and Dean</strong> before binding the thesis</div>
                    <div class="text-danger">*Hard Cover Thesis 1 Copies <strong>(Dark Blue)</strong></div>
                    <br />
                    <div>Content list of Finalized Documents (.zip): </div>
                    <div class="row py-2">
                        <ol>
                            <li>Soft Copy Thesis <strong>(.doc / .docx)</strong></li>
                            <li>Soft Copy Thesis <strong>PDF</strong></li>
                            <li>Source Code Executables File & Supporting Softwares</li>
                            <li>User Manual & Installer Guide</li>
                            <li>Summary of Thesis Report in English, <strong>Max 6 Pages (.doc / .docx)</strong></li>
                            <li>Summary of Thesis Report in Bahasa, <strong>Max 6 Pages (.doc / .docx)</strong></li>
                            <li>Power Point Slide</li>
                            <li>Authors Declaration of Originality</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
