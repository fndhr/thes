@extends('layouts.app')

@section('content')
<div id="StudentDetail" class="container">
    <div class="row my-5">
        <div class="col-12 text-center">
            <h1>Student Detail</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-11">
            <div class="row py-2 mb-2">
                <div class="col-3">Name</div>
                <div class="col-9">:&nbsp;&nbsp;{{$student->user->first_name}} {{$student->user->last_name}}</div>
            </div>
            @php($sts_title = NULL)
            @foreach($student->proposedTitle as $title)
                @if($title->sts_id == 2)
                    @php($sts_title = $title->title_name)
                @endif
            @endforeach
            <div class="row py-2 mb-2">
                <div class="col-3">Title</div>
                <div class="col-7">:&nbsp;&nbsp;{{$sts_title ?? 'unconfirmed'}}</div>
                <div class="col-1">@if(!is_null($sts_title))&#10003;@endif</div>
            </div>
            <div class="row py-2 mb-2">
                <div class="col-3">Advisor</div>
                <div class="col-7">:&nbsp;&nbsp;{{$student->lecturer ? $student->lecturer->user->first_name.' '.$student->lecturer->user->last_name : 'unconfirmed'}}</div>
                <div class="col-1">@if(!is_null($student->lecturer))&#10003;@endif</div>
            </div>
            @if(count($student->documentUpload)>=1)
            @if($student->documentUpload[0]->status==2)
            <div class="row py-2 mb-2">
                <div class="col-3">Proposal</div>
                <div class="col-5" for="ThesisProposal" name="ThesisProposal">:&nbsp;&nbsp;{{$student->documentUpload[0]->doc_name}}</div>
                <div class="col-2"><span class="text-primary downloadFileProposal" onclick="event.preventDefault(); document.getElementById('downloadFileProposal').submit();">Download</span>
                &nbsp;|&nbsp;<span class="text-primary viewFileProposal" onclick="event.preventDefault(); document.getElementById('viewFileProposal').submit();">View</span></div>
                <form id="downloadFileProposal" action="/downloadFileProposal" method="POST" style="display: none;">@csrf<input for="ThesisProposal" name="ThesisProposal" value="{{$student->documentUpload[0]->doc_name}}" style="display:none"><input for="studentId" name="studentId" value="{{$student->std_id}}"style="display:none"></form>
                <form id="viewFileProposal" action="/viewFileProposal" method="POST" style="display: none;" target="_blank">@csrf<input for="ThesisProposal" name="ThesisProposal" value="{{$student->documentUpload[0]->doc_name}}" style="display:none"><input for="studentId" name="studentId" value="{{$student->std_id}}"style="display:none" target="_blank"></form>
                <div class="col-1">&#10003;</div>
            </div>
            @elseif($student->documentUpload[0]->status==1)
            <div class="row py-2 mb-2">
                <div class="col-3">Proposal</div>
                <div class="col-5" for="ThesisProposal" name="ThesisProposal">:&nbsp;&nbsp;{{$student->documentUpload[0]->doc_name}}</div>
                <div class="col-2"><span class="text-primary downloadFileProposal" onclick="event.preventDefault(); document.getElementById('downloadFileProposal').submit();">Download</span>
                &nbsp;|&nbsp;<span class="text-primary viewFileProposal" onclick="event.preventDefault(); document.getElementById('viewFileProposal').submit();">View</span></div>
                <form id="downloadFileProposal" action="/downloadFileProposal" method="POST" style="display: none;">@csrf<input for="ThesisProposal" name="ThesisProposal" value="{{$student->documentUpload[0]->doc_name}}" style="display:none"><input for="studentId" name="studentId" value="{{$student->std_id}}"style="display:none"></form>
                <form id="viewFileProposal" action="/viewFileProposal" method="POST" style="display: none;" target="_blank">@csrf<input for="ThesisProposal" name="ThesisProposal" value="{{$student->documentUpload[0]->doc_name}}" style="display:none"><input for="studentId" name="studentId" value="{{$student->std_id}}"style="display:none" target="_blank"></form>
                </div>
            <div class="row py-2 mb-2">
                <div class="col">
                    <table class="table table-sm table-bordered table-hover">
                        <thead class="thead-dark text-center">
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">File Name</th>
                                <th scope="col" style="width: 15%;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1.</td>
                                <td>{{$student->documentUpload[0]->doc_name}}</td>
                                <td style="display: flex; justify-content: space-around;">
                                    <form id="button-yes-{{$student->documentUpload[0]->id}}" class="submitForm" action="/lecturer/approve/document" method="POST">@csrf<input name="id" value="{{$student->documentUpload[0]->id}}" style="display:none"><input for="std" name="std" value="{{$student->std_id}}" style="display:none">
                                        <button type="submit" class="btn btn-outline-success btn-sm btn-pill btnSubmit py-2 px-3">YES</button>
                                    </form>
                                    <form id="button-no-{{$student->documentUpload[0]->id}}" class="submitForm" action="/lecturer/disapprove/document" method="POST">@csrf<input name="id" value="{{$student->documentUpload[0]->id}}" style="display:none"><input for="std" name="std" value="{{$student->std_id}}" style="display:none">
                                        <button type="submit" class="btn btn-outline-danger btn-sm btn-pill btnSubmit py-2 px-3">NO</button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
            @endif
            @if(count($student->documentUpload)>=2)
            @if($student->documentUpload[1]->status==2)
            <div class="row py-2 mb-2">
                <div class="col-3">Interim</div>
                <div class="col-5" for="ThesisInterim" name="ThesisInterim">:&nbsp;&nbsp;{{$student->documentUpload[1]->doc_name}}</div>
                <div class="col-2"><span class="text-primary downloadFileInterim" onclick="event.preventDefault(); document.getElementById('downloadFileInterim').submit();">Download</span>
                &nbsp;|&nbsp;<span class="text-primary viewFileInterim" onclick="event.preventDefault(); document.getElementById('viewFileInterim').submit();">View</span></div>
                <form id="downloadFileInterim" action="/downloadFileInterim" method="POST" style="display: none;">@csrf<input for="ThesisInterim" name="ThesisInterim" value="{{$student->documentUpload[1]->doc_name}}" style="display:none"><input for="studentId" name="studentId" value="{{$student->std_id}}"style="display:none"></form>
                <form id="viewFileInterim" action="/viewFileInterim" method="POST" style="display: none;" target="_blank">@csrf<input for="ThesisInterim" name="ThesisInterim" value="{{$student->documentUpload[1]->doc_name}}" style="display:none"><input for="studentId" name="studentId" value="{{$student->std_id}}"style="display:none" target="_blank"></form>
                <div class="col-1">&#10003;</div>
            </div>
            @elseif($student->documentUpload[1]->status==1)
            <div class="row py-2 mb-2">
                <div class="col-3">Interim</div>
                <div class="col-5" for="ThesisInterim" name="ThesisInterim">:&nbsp;&nbsp;{{$student->documentUpload[1]->doc_name}}</div>
                <div class="col-2"><span class="text-primary downloadFileInterim" onclick="event.preventDefault(); document.getElementById('downloadFileInterim').submit();">Download</span>
                &nbsp;|&nbsp;<span class="text-primary viewFileInterim" onclick="event.preventDefault(); document.getElementById('viewFileInterim').submit();">View</span></div>
                <form id="downloadFileInterim" action="/downloadFileInterim" method="POST" style="display: none;">@csrf<input for="ThesisInterim" name="ThesisInterim" value="{{$student->documentUpload[1]->doc_name}}" style="display:none"><input for="studentId" name="studentId" value="{{$student->std_id}}"style="display:none"></form>
                <form id="viewFileInterim" action="/viewFileInterim" method="POST" style="display: none;" target="_blank">@csrf<input for="ThesisInterim" name="ThesisInterim" value="{{$student->documentUpload[1]->doc_name}}" style="display:none"><input for="studentId" name="studentId" value="{{$student->std_id}}"style="display:none" target="_blank"></form>
                <div class="col-1">&#10003;</div>
             </div>
            <div class="row py-2 mb-2">
                <div class="col">
                    <table class="table table-sm table-bordered table-hover">
                        <thead class="thead-dark text-center">
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">File Name</th>
                                <th scope="col" style="width: 15%;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1.</td>
                                <td>{{$student->documentUpload[1]->doc_name}}</td>
                                <td style="display: flex; justify-content: space-around;">
                                    <form id="button-yes-{{$student->documentUpload[1]->id}}" class="submitForm" action="/lecturer/approve/document" method="POST">@csrf<input name="id" value="{{$student->documentUpload[1]->id}}" style="display:none"><input for="std" name="std" value="{{$student->std_id}}" style="display:none">
                                        <button type="submit" class="btn btn-outline-success btn-sm btn-pill btnSubmit py-2 px-3">YES</button>
                                    </form>
                                    <form id="button-no-{{$student->documentUpload[1]->id}}" class="submitForm" action="/lecturer/disapprove/document" method="POST">@csrf<input name="id" value="{{$student->documentUpload[1]->id}}" style="display:none"><input for="std" name="std" value="{{$student->std_id}}" style="display:none">
                                        <button type="submit" class="btn btn-outline-danger btn-sm btn-pill btnSubmit py-2 px-3">NO</button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
            @endif
            @if(count($student->documentUpload)>=3)
            @if($student->documentUpload[2]->status==2)
                <div class="row py-2 mb-2">
                    <div class="col-3">Final Draft</div>
                    <div class="col-5" for="FinalDraft" name="FinalDraft">:&nbsp;&nbsp;{{$student->documentUpload[2]->doc_name}}</div>
                    <div class="col-2"><span class="text-primary downloadFileFinalDraft" onclick="event.preventDefault(); document.getElementById('downloadFileFinalDraft').submit();">Download</span>
                    &nbsp;|&nbsp;<span class="text-primary viewFileFinalDraft" onclick="event.preventDefault(); document.getElementById('viewFileFinalDraft').submit();">View</span></div>
                    <form id="downloadFileFinalDraft" action="/downloadFileFinalDraft" method="POST" style="display: none;">@csrf<input for="FinalDraft" name="FinalDraft" value="{{$student->documentUpload[2]->doc_name}}" style="display:none"><input for="studentId" name="studentId" value="{{$student->std_id}}"style="display:none"></form>
                    <form id="viewFileFinalDraft" action="/viewFileFinalDraft" method="POST" style="display: none;" target="_blank">@csrf<input for="FinalDraft" name="FinalDraft" value="{{$student->documentUpload[2]->doc_name}}" style="display:none"><input for="studentId" name="studentId" value="{{$student->std_id}}"style="display:none" target="_blank"></form>
                    <div class="col-1">&#10003;</div>
                </div>
                
                @if(!is_null($sts_title) && !is_null($student->lecturer))
                    <div class="row py-2 mb-2">
                        <div class="col-3">Defense Date</div>
                        <div class="col-5">:&nbsp;&nbsp;@if(is_null($student->defense))Not Set @else{{$student->defense->date}} {{$student->defense->time}}@endif</div>
                        <div class="col-2">@if(!is_null($student->defense))<a href="/lecturer/getDefenseScheduleDetail/{{$student->std_id}}">View</a>@endif</div>
                        <div class="col-1">@if(!is_null($student->defense))&#10003;@endif</div>
                    </div>
                @endif
            @elseif($student->documentUpload[2]->status==1)
                <div class="row py-2 mb-2">
                    <div class="col-3">Final Draft</div>
                    <div class="col-5" for="FinalDraft" name="FinalDraft">:&nbsp;&nbsp;{{$student->documentUpload[2]->doc_name}}</div>
                    <div class="col-2"><span class="text-primary downloadFileFinalDraft" onclick="event.preventDefault(); document.getElementById('downloadFileFinalDraft').submit();">Download</span>
                    &nbsp;|&nbsp;<span class="text-primary viewFileFinalDraft" onclick="event.preventDefault(); document.getElementById('viewFileFinalDraft').submit();">View</span></div>
                    <form id="downloadFileFinalDraft" action="/downloadFileFinalDraft" method="POST" style="display: none;">@csrf<input for="FinalDraft" name="FinalDraft" value="{{$student->documentUpload[2]->doc_name}}" style="display:none"><input for="studentId" name="studentId" value="{{$student->std_id}}"style="display:none"></form>
                    <form id="viewFileFinalDraft" action="/viewFileFinalDraft" method="POST" style="display: none;" target="_blank">@csrf<input for="FinalDraft" name="FinalDraft" value="{{$student->documentUpload[2]->doc_name}}" style="display:none"><input for="studentId" name="studentId" value="{{$student->std_id}}"style="display:none" target="_blank"></form>
                    <div class="col-1">&#10003;</div>
                </div>
                <div class="row py-2 mb-2">
                    <div class="col">
                        <table class="table table-sm table-bordered table-hover">
                            <thead class="thead-dark text-center">
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">File Name</th>
                                    <th scope="col" style="width: 15%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1.</td>
                                    <td>{{$student->documentUpload[2]->doc_name}}</td>
                                    <td style="display: flex; justify-content: space-around;">
                                        <form id="button-yes-{{$student->documentUpload[2]->id}}" class="submitForm" action="/lecturer/approve/document" method="POST">@csrf<input name="id" value="{{$student->documentUpload[2]->id}}" style="display:none"><input for="std" name="std" value="{{$student->std_id}}" style="display:none">
                                            <button type="submit" class="btn btn-outline-success btn-sm btn-pill btnSubmit py-2 px-3">YES</button>
                                        </form>
                                        <form id="button-no-{{$student->documentUpload[2]->id}}" class="submitForm" action="/lecturer/disapprove/document" method="POST">@csrf<input name="id" value="{{$student->documentUpload[2]->id}}" style="display:none"><input for="std" name="std" value="{{$student->std_id}}" style="display:none">
                                            <button type="submit" class="btn btn-outline-danger btn-sm btn-pill btnSubmit py-2 px-3">NO</button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
            @endif
            @if(count($student->documentUpload)>=4)
            @if($student->documentUpload[3]->status==2)
                @if($student->documentUpload[3]->doc_type_name == 'Signed Revised Document')
                <div class="row py-2 mb-2">
                    <div class="col-3">Revision</div>
                    <div class="col-5" for="signedRevisedDoc" name="signedRevisedDoc">:&nbsp;&nbsp;{{$student->documentUpload[3]->doc_name}}</div>
                    <div class="col-2"><span class="text-primary downloadFileRevisedDoc" onclick="event.preventDefault(); document.getElementById('downloadFileRevisedDoc').submit();">Download</span>
                    &nbsp;|&nbsp;<span class="text-primary viewFileRevisedDoc" onclick="event.preventDefault(); document.getElementById('viewFileRevisedDoc').submit();">View</span></div>                    
                    <form id="downloadFileRevisedDoc" action="/downloadFileRevisedDoc" method="POST" style="display: none;">@csrf<input for="signedRevisedDoc" name="signedRevisedDoc" value="{{$student->documentUpload[3]->doc_name}}" style="display:none"><input for="studentId" name="studentId" value="{{$student->std_id}}"style="display:none"></form>
                    <form id="viewFileRevisedDoc" action="/viewFileRevisedDoc" method="POST" style="display: none;" target="_blank">@csrf<input for="signedRevisedDoc" name="signedRevisedDoc" value="{{$student->documentUpload[3]->doc_name}}" style="display:none"><input for="studentId" name="studentId" value="{{$student->std_id}}"style="display:none" target="_blank"></form>
                    <div class="col-1">&#10003;</div>
                </div>
                @else
                <div class="row py-2 mb-2">
                    <div class="col-3">Final Document</div>
                    <div class="col-5" for="finalizedDoc" name="finalizedDoc">:&nbsp;&nbsp;{{$student->documentUpload[4]->doc_name}}</div>
                    <div class="col-2"><span class="text-primary downloadFileFinalDraft" onclick="event.preventDefault(); document.getElementById('downloadFileFinalizedDoc').submit();">Download</span>
                    &nbsp;|&nbsp;<span class="text-primary viewFileFinalizedDoc" onclick="event.preventDefault(); document.getElementById('viewFileFinalizedDoc').submit();">View</span></div>                    
                    <form id="downloadFileFinalizedDoc" action="/downloadFileFinalizedDoc" method="POST" style="display: none;">@csrf<input for="finalizedDoc" name="finalizedDoc" value="{{$student->documentUpload[4]->doc_name}}" style="display:none"><input for="studentId" name="studentId" value="{{$student->std_id}}"style="display:none"></form>
                    <form id="viewFileFinalizedDoc" action="/viewFileFinalizedDoc" method="POST" style="display: none;" target="_blank">@csrf<input for="finalizedDoc" name="finalizedDoc" value="{{$student->documentUpload[4]->doc_name}}" style="display:none"><input for="studentId" name="studentId" value="{{$student->std_id}}"style="display:none"  target="_blank"></form>
                    <div class="col-1">&#10003;</div>
                </div>
                @endif
            @elseif($student->documentUpload[3]->status==1)
                @if($student->documentUpload[3]->doc_type_name == 'Signed Revised Document')
                <div class="row py-2 mb-2">
                    <div class="col-3">Revision</div>
                    <div class="col-5" for="signedRevisedDoc" name="signedRevisedDoc">:&nbsp;&nbsp;{{$student->documentUpload[3]->doc_name}}</div>
                    <div class="col-2"><span class="text-primary downloadFileRevisedDoc" onclick="event.preventDefault(); document.getElementById('downloadFileRevisedDoc').submit();">Download</span>
                    &nbsp;|&nbsp;<span class="text-primary viewFileRevisedDoc" onclick="event.preventDefault(); document.getElementById('viewFileRevisedDoc').submit();">View</span></div>                    
                    <form id="downloadFileRevisedDoc" action="/downloadFileRevisedDoc" method="POST" style="display: none;">@csrf<input for="signedRevisedDoc" name="signedRevisedDoc" value="{{$student->documentUpload[3]->doc_name}}" style="display:none"><input for="studentId" name="studentId" value="{{$student->std_id}}"style="display:none"></form>
                    <form id="viewFileRevisedDoc" action="/viewFileRevisedDoc" method="POST" style="display: none;" target="_blank">@csrf<input for="signedRevisedDoc" name="signedRevisedDoc" value="{{$student->documentUpload[3]->doc_name}}" style="display:none"><input for="studentId" name="studentId" value="{{$student->std_id}}"style="display:none" target="_blank"></form>
                    <div class="col-1">&#10003;</div>
                </div>
                @else
                <div class="row py-2 mb-2">
                    <div class="col-3">Final Document</div>
                    <div class="col-5" for="finalizedDoc" name="finalizedDoc">:&nbsp;&nbsp;{{$student->documentUpload[4]->doc_name}}</div>
                    <div class="col-2"><span class="text-primary downloadFileFinalDraft" onclick="event.preventDefault(); document.getElementById('downloadFileFinalizedDoc').submit();">Download</span>
                    &nbsp;|&nbsp;<span class="text-primary viewFileFinalizedDoc" onclick="event.preventDefault(); document.getElementById('viewFileFinalizedDoc').submit();">View</span></div>                    
                    <form id="downloadFileFinalizedDoc" action="/downloadFileFinalizedDoc" method="POST" style="display: none;">@csrf<input for="finalizedDoc" name="finalizedDoc" value="{{$student->documentUpload[4]->doc_name}}" style="display:none"><input for="studentId" name="studentId" value="{{$student->std_id}}"style="display:none"></form>
                    <form id="viewFileFinalizedDoc" action="/viewFileFinalizedDoc" method="POST" style="display: none;" target="_blank">@csrf<input for="finalizedDoc" name="finalizedDoc" value="{{$student->documentUpload[4]->doc_name}}" style="display:none"><input for="studentId" name="studentId" value="{{$student->std_id}}"style="display:none"  target="_blank"></form>
                    <div class="col-1">&#10003;</div>
                </div>
                @endif
                <div class="row py-2 mb-2">
                    <div class="col">
                        <table class="table table-sm table-bordered table-hover">
                            <thead class="thead-dark text-center">
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">File Name</th>
                                    <th scope="col" style="width: 15%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1.</td>
                                    <td>{{$student->documentUpload[3]->doc_name}}</td>
                                    <td style="display: flex; justify-content: space-around;">
                                        <form id="button-yes-{{$student->documentUpload[3]->id}}" class="submitForm" action="/lecturer/approve/document" method="POST">@csrf<input name="id" value="{{$student->documentUpload[3]->id}}" style="display:none"><input for="std" name="std" value="{{$student->std_id}}" style="display:none">
                                            <button type="submit" class="btn btn-outline-success btn-sm btn-pill btnSubmit py-2 px-3">YES</button>
                                        </form>
                                        <form id="button-no-{{$student->documentUpload[3]->id}}" class="submitForm" action="/lecturer/disapprove/document" method="POST">@csrf<input name="id" value="{{$student->documentUpload[3]->id}}" style="display:none"><input for="std" name="std" value="{{$student->std_id}}" style="display:none">
                                            <button type="submit" class="btn btn-outline-danger btn-sm btn-pill btnSubmit py-2 px-3">NO</button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
            @endif
            @if(count($student->documentUpload)>=5)
            @if($student->documentUpload[4]->status==2)
                @if($student->documentUpload[4]->doc_type_name == 'Signed Revised Document')
                <div class="row py-2 mb-2">
                    <div class="col-3">Revision</div>
                    <div class="col-5" for="signedRevisedDoc" name="signedRevisedDoc">:&nbsp;&nbsp;{{$student->documentUpload[3]->doc_name}}</div>
                    <div class="col-2"><span class="text-primary downloadFileRevisedDoc" onclick="event.preventDefault(); document.getElementById('downloadFileRevisedDoc').submit();">Download</span>
                    &nbsp;|&nbsp;<span class="text-primary viewFileRevisedDoc" onclick="event.preventDefault(); document.getElementById('viewFileRevisedDoc').submit();">View</span></div>                    
                    <form id="downloadFileRevisedDoc" action="/downloadFileRevisedDoc" method="POST" style="display: none;">@csrf<input for="signedRevisedDoc" name="signedRevisedDoc" value="{{$student->documentUpload[3]->doc_name}}" style="display:none"><input for="studentId" name="studentId" value="{{$student->std_id}}"style="display:none"></form>
                    <form id="viewFileRevisedDoc" action="/viewFileRevisedDoc" method="POST" style="display: none;" target="_blank">@csrf<input for="signedRevisedDoc" name="signedRevisedDoc" value="{{$student->documentUpload[3]->doc_name}}" style="display:none"><input for="studentId" name="studentId" value="{{$student->std_id}}"style="display:none" target="_blank"></form>
                    <div class="col-1">&#10003;</div>
                </div>
                @else
                <div class="row py-2 mb-2">
                    <div class="col-3">Final Document</div>
                    <div class="col-5" for="finalizedDoc" name="finalizedDoc">:&nbsp;&nbsp;{{$student->documentUpload[4]->doc_name}}</div>
                    <div class="col-2"><span class="text-primary downloadFileFinalDraft" onclick="event.preventDefault(); document.getElementById('downloadFileFinalizedDoc').submit();">Download</span>
                    &nbsp;|&nbsp;<span class="text-primary viewFileFinalizedDoc" onclick="event.preventDefault(); document.getElementById('viewFileFinalizedDoc').submit();">View</span></div>                    
                    <form id="downloadFileFinalizedDoc" action="/downloadFileFinalizedDoc" method="POST" style="display: none;">@csrf<input for="finalizedDoc" name="finalizedDoc" value="{{$student->documentUpload[4]->doc_name}}" style="display:none"><input for="studentId" name="studentId" value="{{$student->std_id}}"style="display:none"></form>
                    <form id="viewFileFinalizedDoc" action="/viewFileFinalizedDoc" method="POST" style="display: none;" target="_blank">@csrf<input for="finalizedDoc" name="finalizedDoc" value="{{$student->documentUpload[4]->doc_name}}" style="display:none"><input for="studentId" name="studentId" value="{{$student->std_id}}"style="display:none"  target="_blank"></form>
                    <div class="col-1">&#10003;</div>
                </div>
                @endif
            @elseif($student->documentUpload[4]->status==1)
                @if($student->documentUpload[4]->doc_type_name == 'Signed Revised Document')
                <div class="row py-2 mb-2">
                    <div class="col-3">Revision</div>
                    <div class="col-5" for="signedRevisedDoc" name="signedRevisedDoc">:&nbsp;&nbsp;{{$student->documentUpload[3]->doc_name}}</div>
                    <div class="col-2"><span class="text-primary downloadFileRevisedDoc" onclick="event.preventDefault(); document.getElementById('downloadFileRevisedDoc').submit();">Download</span>
                    &nbsp;|&nbsp;<span class="text-primary viewFileRevisedDoc" onclick="event.preventDefault(); document.getElementById('viewFileRevisedDoc').submit();">View</span></div>                    
                    <form id="downloadFileRevisedDoc" action="/downloadFileRevisedDoc" method="POST" style="display: none;">@csrf<input for="signedRevisedDoc" name="signedRevisedDoc" value="{{$student->documentUpload[3]->doc_name}}" style="display:none"><input for="studentId" name="studentId" value="{{$student->std_id}}"style="display:none"></form>
                    <form id="viewFileRevisedDoc" action="/viewFileRevisedDoc" method="POST" style="display: none;" target="_blank">@csrf<input for="signedRevisedDoc" name="signedRevisedDoc" value="{{$student->documentUpload[3]->doc_name}}" style="display:none"><input for="studentId" name="studentId" value="{{$student->std_id}}"style="display:none" target="_blank"></form>
                    <div class="col-1">&#10003;</div>
                </div>
                @else
                <div class="row py-2 mb-2">
                    <div class="col-3">Final Document</div>
                    <div class="col-5" for="finalizedDoc" name="finalizedDoc">:&nbsp;&nbsp;{{$student->documentUpload[4]->doc_name}}</div>
                    <div class="col-2"><span class="text-primary downloadFileFinalDraft" onclick="event.preventDefault(); document.getElementById('downloadFileFinalizedDoc').submit();">Download</span>
                    &nbsp;|&nbsp;<span class="text-primary viewFileFinalizedDoc" onclick="event.preventDefault(); document.getElementById('viewFileFinalizedDoc').submit();">View</span></div>                    
                    <form id="downloadFileFinalizedDoc" action="/downloadFileFinalizedDoc" method="POST" style="display: none;">@csrf<input for="finalizedDoc" name="finalizedDoc" value="{{$student->documentUpload[4]->doc_name}}" style="display:none"><input for="studentId" name="studentId" value="{{$student->std_id}}"style="display:none"></form>
                    <form id="viewFileFinalizedDoc" action="/viewFileFinalizedDoc" method="POST" style="display: none;" target="_blank">@csrf<input for="finalizedDoc" name="finalizedDoc" value="{{$student->documentUpload[4]->doc_name}}" style="display:none"><input for="studentId" name="studentId" value="{{$student->std_id}}"style="display:none"  target="_blank"></form>
                    <div class="col-1">&#10003;</div>
                </div>
                @endif
                <div class="row py-2 mb-2">
                    <div class="col">
                        <table class="table table-sm table-bordered table-hover">
                            <thead class="thead-dark text-center">
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">File Name</th>
                                    <th scope="col" style="width: 15%;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1.</td>
                                    <td>{{$student->documentUpload[4]->doc_name}}</td>
                                    <td style="display: flex; justify-content: space-around;">
                                        <form id="button-yes-{{$student->documentUpload[4]->id}}" class="submitForm" action="/lecturer/approve/document" method="POST">@csrf<input name="id" value="{{$student->documentUpload[4]->id}}" style="display:none"><input for="std" name="std" value="{{$student->std_id}}" style="display:none">
                                            <button type="submit" class="btn btn-outline-success btn-sm btn-pill btnSubmit py-2 px-3">YES</button>
                                        </form>
                                        <form id="button-no-{{$student->documentUpload[4]->id}}" class="submitForm" action="/lecturer/disapprove/document" method="POST">@csrf<input name="id" value="{{$student->documentUpload[4]->id}}" style="display:none"><input for="std" name="std" value="{{$student->std_id}}" style="display:none">
                                            <button type="submit" class="btn btn-outline-danger btn-sm btn-pill btnSubmit py-2 px-3">NO</button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
            @endif
            <div class="row py-2 mb-2">
                <div class="col-3">Final Score</div>
                @if(count($student->scoringTable)==0)
                <div class="col">:&nbsp;&nbsp;Not Set</div>
                @elseif(count($student->scoringTable) < 3)
                    <div class="col">:&nbsp;&nbsp;Waiting for @php($tot=count($student->scoringTable->lecturers))@php($c=0)@foreach($student->scoringTable->lecturers as $lecturer){{$lecturer->user->first_name.' '.$lecturer->user->last_name}}@php($c++)@if($c!=$tot) , @endif @endforeach to submit the score</div>  
                @else
                    <div class="col">:&nbsp;&nbsp;{{$student->scoringTable->totalScore}}</div>                    
                @endif
            </div>
        </div>
    </div>
</div>


<div id="StudentDetail" class="container">
    <div class="row my-5">
        <div class="col-12 text-center">
            <h1>Consultation Sheet</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-11">
            <div class="row py-2 mb-2">
                <div class="col-3">Status</div>
                @php($consult = 0)
                @foreach($student->proposedConsultations as $std)
                    @if($std->sts_id == 2)
                        @php($consult++)
                    @endif
                @endforeach
                <div class="col-7">:&nbsp;&nbsp;@if($consult < $student->session->minimum_consultation)Haven't Reach Minimum Requirement @else Eligible to set thesis defense @endif</div>    
            </div>
           
            <div class="row py-2 mb-2">
                <div class="col">
                    <h4>Waiting for Approval</h4>
                    <table class="table table-sm table-bordered table-hover">
                        <thead class="thead-dark text-center">
                            <tr>
                                <th scope="col" style="width: 5%;">No.</th>
                                <th scope="col" style="width: 20%;">Date</th>
                                <th scope="col" style="width: 60%;">Topic</th>
                                <th scope="col" style="width: 15%;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($proposed = 1)
                            @foreach($student->proposedConsultations as $consultation)
                                @if($consultation->sts_id ==1)
                                <tr>
                                    <td>{{$proposed}}.</td>
                                    <td>{{$consultation->proposed_date}}</td>
                                    <td>{{$consultation->topic_name}}</td>
                                    <td style="display: flex; justify-content: space-around;">
                                        <form id="button-yes{{$consultation->id}}" class="submitForm" action="/lecturer/approve/consultation" method="POST">@csrf<input for="title" name="id" value="{{$consultation->id}}" style="display:none"><input for="std" name="std" value="{{$student->std_id}}" style="display:none">
                                            <button type="submit" class="btn btn-outline-success btn-sm btn-pill btnSubmit py-2 px-3">YES</button>
                                        </form>
                                        <form id="button-no{{$consultation->id}}" class="submitForm" action="/lecturer/disapprove/consultation" method="POST">@csrf<input for="title" name="id" value="{{$consultation->id}}" style="display:none"><input for="std" name="std" value="{{$student->std_id}}" style="display:none">
                                            <button type="submit" class="btn btn-outline-danger btn-sm btn-pill btnSubmit py-2 px-3">NO</button>
                                        </form>
                                    </td>
                                </tr>
                                @php($proposed++)
                                @endif
                            @endforeach     
                            @if($proposed == 1)
                                <tr>
                                    <td colspan="4" class="text-center">Records Not Found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row py-2 mb-2">
                <div class="col">
                    <h4>Consultation History</h4>
                    <table class="table table-sm table-bordered table-hover">
                        <thead class="thead-dark text-center">
                            <tr>
                                <th scope="col" style="width: 5%;">No.</th>
                                <th scope="col" style="width: 20%;">Date</th>
                                <th scope="col" style="width: 55%;">Topic</th>
                                <th scope="col" style="width: 20%;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($proposed = 1)
                            @foreach($student->proposedConsultations as $consultation)
                                @if($consultation->sts_id !=1)
                                <tr>
                                    <td>{{$proposed}}.</td>
                                    <td>{{$consultation->proposed_date}}</td>
                                    <td>{{$consultation->topic_name}}</td>
                                    <td>{{$consultation->status->sts_name}}</td>
                                </tr>
                                @php($proposed++)
                                @endif
                            @endforeach     
                            @if($proposed == 1)
                                <tr>
                                    <td colspan="4" class="text-center">Records Not Found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div> 
        </div>
    </div>
</div>  
@endsection