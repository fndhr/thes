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
            <div class="row py-2 mb-2">
                <div class="col-3">Consultation Sheet</div>
                @php($consult = 0)
                @foreach($student->proposedConsultations as $std)
                    @if($std->sts_id == 2)
                        @php($consult++)
                    @endif
                @endforeach
                <div class="col-7">:&nbsp;&nbsp;@if($consult < $student->session->minimum_consultation)Haven't Reach Minimum Requirement @else Eligible to set thesis defense @endif</div>
                <div class="col-1">@if(!is_null($student->lecturer))&#10003;@endif</div>
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
            @if($numberPropTitle>0)
            <div class="row py-2 mb-2">
                <div class="col">
                    <table class="table table-sm table-bordered table-hover">
                        <thead class="thead-dark text-center">
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Title</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($num = 1)
                            @foreach($student->proposedTitle as $title)
                            @if($title->sts_id == 1)
                            <tr>
                                <td>{{$num}}.</td>
                                <td>{{$title->title_name}}</td>
                                <td>
                                    <span class="text-success submitPropose" onclick="event.preventDefault(); document.getElementById('button-yes-title{{$title->title_id}}').submit();">YES</span>&emsp;
                                    <span class="text-danger submitPropose" onclick="event.preventDefault(); document.getElementById('button-no-title{{$title->title_id}}').submit();">NO</span>
                                </td>    
                                <form id="button-yes-title{{$title->title_id}}" action="/admin/approve/title" method="POST" style="display: none;">@csrf<input for="title" name="title" value="{{$title->title_id}}" style="display:none"><input for="std" name="std" value="{{$student->std_id}}" style="display:none"></form>
                                <form id="button-no-title{{$title->title_id}}" action="/admin/disapprove/title" method="POST" style="display: none;">@csrf<input for="title" name="title" value="{{$title->title_id}}" style="display:none"><input for="std" name="std" value="{{$student->std_id}}" style="display:none"></form>
                                @php($num++)
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
            <div class="row py-2 mb-2">
                <div class="col-3">Advisor</div>
                <div class="col-7">:&nbsp;&nbsp;{{$student->lecturer ? $student->lecturer->user->first_name.' '.$student->lecturer->user->last_name : 'unconfirmed'}}</div>
                <div class="col-1">@if(!is_null($student->lecturer))&#10003;@endif</div>
            </div>
            @if($numberPropAdv>0)
            <div class="row py-2 mb-2">
                <div class="col">
                    <table class="table table-sm table-bordered table-hover">
                        <thead class="thead-dark text-center">
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Advisor</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($num = 1)
                            @foreach($student->proposedAdvisor as $advisor)
                                @if($advisor->sts_id == 1)
                                <tr>
                                    <td>{{$num}}.</td>
                                    <td>{{$advisor->lecturer->user->first_name.' '.$advisor->lecturer->user->last_name}}</td>
                                    <td>
                                        <span class="text-success submitPropose" onclick="event.preventDefault(); document.getElementById('button-yes-advisor{{$advisor->advisor_id}}').submit();">YES</span>&emsp;
                                        <span class="text-danger submitPropose" onclick="event.preventDefault(); document.getElementById('button-no-advisor{{$advisor->advisor_id}}').submit();">NO</span></td>
                                    <form id="button-yes-advisor{{$advisor->advisor_id}}" action="/admin/approve/advisor" method="POST" style="display: none;">@csrf<input for="advisor" name="advisor" value="{{$advisor->advisor_id}}" style="display:none"><input for="std" name="std" value="{{$student->std_id}}" style="display:none"></form>
                                    <form id="button-no-advisor{{$advisor->advisor_id}}" action="/admin/disapprove/advisor" method="POST" style="display: none;">@csrf<input for="advisor" name="advisor" value="{{$advisor->advisor_id}}" style="display:none"><input for="std" name="std" value="{{$student->std_id}}" style="display:none"></form>
                                </tr>
                                @php($num++)
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
            {{ csrf_field() }}
            <div class="row py-2 mb-2" style="display:none">
                <div class="col-3">NIK</div>
                <div class="col-9" for="nik" name="nik">:&nbsp;&nbsp;{{$student->std_id}}</div>
            </div>
            @if(count($student->documentUpload)>=1 && $student->documentUpload[0]->status==2)
            <div class="row py-2 mb-2">
                <div class="col-3">Proposal</div>
                <div class="col-5" for="ThesisProposal" name="ThesisProposal">:&nbsp;&nbsp;{{$student->documentUpload[0]->doc_name}}</div>
                <div class="col-2"><span class="text-success downloadFileProposal" onclick="event.preventDefault(); document.getElementById('downloadFileProposal').submit();">Download</span>
                &nbsp;|&nbsp;<span class="text-success viewFileProposal" onclick="event.preventDefault(); document.getElementById('viewFileProposal').submit();">View</span></div>
                <form id="downloadFileProposal" action="/downloadFileProposal" method="POST" style="display: none;">@csrf<input for="ThesisProposal" name="ThesisProposal" value="{{$student->documentUpload[0]->doc_name}}" style="display:none"><input for="studentId" name="studentId" value="{{$student->std_id}}"style="display:none"></form>
                <form id="viewFileProposal" action="/viewFileProposal" method="POST" style="display: none;">@csrf<input for="ThesisProposal" name="ThesisProposal" value="{{$student->documentUpload[0]->doc_name}}" style="display:none"><input for="studentId" name="studentId" value="{{$student->std_id}}"style="display:none"></form>
                <div class="col-1">&#10003;</div>
            </div>
            @endif
            @if(count($student->documentUpload)>=2 && $student->documentUpload[1]->status==2)
            <div class="row py-2 mb-2">
                <div class="col-3">Interim</div>
                <div class="col-5" for="ThesisInterim" name="ThesisInterim">:&nbsp;&nbsp;{{$student->documentUpload[1]->doc_name}}</div>
                <div class="col-2"><span class="text-success downloadFileInterim" onclick="event.preventDefault(); document.getElementById('downloadFileInterim').submit();">Download</span>
                &nbsp;|&nbsp;<span class="text-success viewFileInterim" onclick="event.preventDefault(); document.getElementById('viewFileInterim').submit();">View</span></div>
                <form id="downloadFileInterim" action="/downloadFileInterim" method="POST" style="display: none;">@csrf<input for="ThesisInterim" name="ThesisInterim" value="{{$student->documentUpload[1]->doc_name}}" style="display:none"><input for="studentId" name="studentId" value="{{$student->std_id}}"style="display:none"></form>
                <form id="viewFileInterim" action="/viewFileInterim" method="POST" style="display: none;">@csrf<input for="ThesisInterim" name="ThesisInterim" value="{{$student->documentUpload[1]->doc_name}}" style="display:none"><input for="studentId" name="studentId" value="{{$student->std_id}}"style="display:none"></form>
                <div class="col-1">&#10003;</div>
            </div>
            @endif
            @if(count($student->documentUpload)>=3 && $student->documentUpload[2]->status==2)
                <div class="row py-2 mb-2">
                    <div class="col-3">Final Draft</div>
                    <div class="col-5" for="FinalDraft" name="FinalDraft">:&nbsp;&nbsp;{{$student->documentUpload[2]->doc_name}}</div>
                    <div class="col-2"><span class="text-success downloadFileFinalDraft" onclick="event.preventDefault(); document.getElementById('downloadFileFinalDraft').submit();">Download</span>
                    &nbsp;|&nbsp;<span class="text-success viewFileFinalDraft" onclick="event.preventDefault(); document.getElementById('viewFileFinalDraft').submit();">View</span></div>
                    <form id="downloadFileFinalDraft" action="/downloadFileFinalDraft" method="POST" style="display: none;">@csrf<input for="FinalDraft" name="FinalDraft" value="{{$student->documentUpload[2]->doc_name}}" style="display:none"><input for="studentId" name="studentId" value="{{$student->std_id}}"style="display:none"></form>
                    <form id="viewFileFinalDraft" action="/viewFileFinalDraft" method="POST" style="display: none;">@csrf<input for="FinalDraft" name="FinalDraft" value="{{$student->documentUpload[2]->doc_name}}" style="display:none"><input for="studentId" name="studentId" value="{{$student->std_id}}"style="display:none"></form>
                    <div class="col-1">&#10003;</div>
                </div>
                @if(!is_null($sts_title) && !is_null($student->lecturer) && ($consult >= $student->session->minimum_consultation))
                    <div class="row py-2 mb-2">
                        <div class="col-3">Defense Date</div>
                        <div class="col-5">:&nbsp;&nbsp;@if(is_null($student->defense))Not Set @else{{$student->defense->date}} {{$student->defense->time}}@endif</div>
                        <div class="col-2">@if(!is_null($student->defense))<a href="/admin/getDefenseScheduleDetail/{{$student->std_id}}">View</a>&nbsp;|&nbsp;@endif<a href="/admin/setDefenseSchedule/{{$student->std_id}}">Set</a></div>
                        <div class="col-1">@if(!is_null($student->defense))&#10003;@endif</div>
                    </div>
                @endif
            @endif
            @if(count($student->documentUpload)>=4  && $student->documentUpload[3]->status==2)
                <div class="row py-2 mb-2">
                    <div class="col-3">Revision</div>
                    <div class="col-5" for="signedRevisedDoc" name="signedRevisedDoc">:&nbsp;&nbsp;{{$student->documentUpload[3]->doc_name}}</div>
                    <div class="col-2"><span class="text-success downloadFileRevisedDoc" onclick="event.preventDefault(); document.getElementById('downloadFileRevisedDoc').submit();">Download</span>
                    &nbsp;|&nbsp;<span class="text-success viewFileRevisedDoc" onclick="event.preventDefault(); document.getElementById('viewFileRevisedDoc').submit();">View</span></div>                    
                    <form id="downloadFileRevisedDoc" action="/downloadFileRevisedDoc" method="POST" style="display: none;">@csrf<input for="signedRevisedDoc" name="signedRevisedDoc" value="{{$student->documentUpload[3]->doc_name}}" style="display:none"><input for="studentId" name="studentId" value="{{$student->std_id}}"style="display:none"></form>
                    <form id="viewFileRevisedDoc" action="/viewFileRevisedDoc" method="POST" style="display: none;">@csrf<input for="signedRevisedDoc" name="signedRevisedDoc" value="{{$student->documentUpload[3]->doc_name}}" style="display:none"><input for="studentId" name="studentId" value="{{$student->std_id}}"style="display:none"></form>
                    <div class="col-1">&#10003;</div>
                </div>
            @endif
            @if(count($student->documentUpload)>=5 && $student->documentUpload[4]->status==2)
                <div class="row py-2 mb-2">
                    <div class="col-3">Final Document</div>
                    <div class="col-5" for="finalizedDoc" name="finalizedDoc">:&nbsp;&nbsp;{{$student->documentUpload[4]->doc_name}}</div>
                    <div class="col-2"><span class="text-success downloadFileFinalDraft" onclick="event.preventDefault(); document.getElementById('downloadFileFinalizedDoc').submit();">Download</span>
                    &nbsp;|&nbsp;<span class="text-success viewFileFinalizedDoc" onclick="event.preventDefault(); document.getElementById('viewFileFinalizedDoc').submit();">View</span></div>                    
                    <form id="downloadFileFinalizedDoc" action="/downloadFileFinalizedDoc" method="POST" style="display: none;">@csrf<input for="finalizedDoc" name="finalizedDoc" value="{{$student->documentUpload[4]->doc_name}}" style="display:none"><input for="studentId" name="studentId" value="{{$student->std_id}}"style="display:none"></form>
                    <form id="viewFileFinalizedDoc" action="/viewFileFinalizedDoc" method="POST" style="display: none;">@csrf<input for="finalizedDoc" name="finalizedDoc" value="{{$student->documentUpload[4]->doc_name}}" style="display:none"><input for="studentId" name="studentId" value="{{$student->std_id}}"style="display:none"></form>
                    <div class="col-1">&#10003;</div>
                </div>
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
@endsection