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
            @if(count($student->documentUpload)>=1)
            <div class="row py-2 mb-2">
                <div class="col-3">Proposal</div>
                <div class="col-5" for="ThesisProposal" name="ThesisProposal">:&nbsp;&nbsp;{{$student->documentUpload[0]->doc_name}}</div>
                <div class="col-2"><span class="text-success downloadFileProposal" onclick="event.preventDefault(); document.getElementById('downloadFileProposal').submit();">Download</span></div>
                <form id="downloadFileProposal" action="/downloadFileProposal" method="POST" style="display: none;">@csrf<input for="ThesisProposal" name="ThesisProposal" value="{{$student->documentUpload[0]->doc_name}}" style="display:none"><input for="studentId" name="studentId" value="{{$student->std_id}}"style="display:none"></form>
                <div class="col-1">&#10003;</div>
            </div>
            @endif
            @if(count($student->documentUpload)>=2)
            <div class="row py-2 mb-2">
                <div class="col-3">Interim</div>
                <div class="col-5" for="ThesisInterim" name="ThesisInterim">:&nbsp;&nbsp;{{$student->documentUpload[1]->doc_name}}</div>
                <div class="col-2"><span class="text-success downloadFileInterim" onclick="event.preventDefault(); document.getElementById('downloadFileInterim').submit();">Download</span></div>
                <form id="downloadFileInterim" action="/downloadFileInterim" method="POST" style="display: none;">@csrf<input for="ThesisInterim" name="ThesisInterim" value="{{$student->documentUpload[1]->doc_name}}" style="display:none"><input for="studentId" name="studentId" value="{{$student->std_id}}"style="display:none"></form>
                <div class="col-1">&#10003;</div>
            </div>
            @endif
            @if(count($student->documentUpload)>=3)
                <div class="row py-2 mb-2">
                    <div class="col-3">Final Draft</div>
                    <div class="col-5" for="FinalDraft" name="FinalDraft">:&nbsp;&nbsp;{{$student->documentUpload[2]->doc_name}}</div>
                    <div class="col-2"><span class="text-success downloadFileFinalDraft" onclick="event.preventDefault(); document.getElementById('downloadFileFinalDraft').submit();">Download</span></div>
                    <form id="downloadFileFinalDraft" action="/downloadFileFinalDraft" method="POST" style="display: none;">@csrf<input for="FinalDraft" name="FinalDraft" value="{{$student->documentUpload[2]->doc_name}}" style="display:none"><input for="studentId" name="studentId" value="{{$student->std_id}}"style="display:none"></form>
                <div class="col-1">&#10003;</div>
                </div>
                @if(!is_null($sts_title) && !is_null($student->lecturer))
                    <div class="row py-2 mb-2">
                        <div class="col-3">Defense Date</div>
                        <div class="col-5">:&nbsp;&nbsp;@if(is_null($student->defense))Not Set @else{{$student->defense->date}} {{$student->defense->time}}@endif</div>
                        <div class="col-2">@if(!is_null($student->defense))<a href="/admin/getDefenseScheduleDetail/{{$student->std_id}}">View</a>&nbsp;|&nbsp;@endif<a href="/admin/setDefenseSchedule/{{$student->std_id}}">Set</a></div>
                        <div class="col-1"></div>
                    </div>
                @endif
            @endif
            <div class="row py-2 mb-2">
                <div class="col-3">Revision</div>
                <div class="col-5">:&nbsp;&nbsp;Not uploaded</div>
                <div class="col-2">Download</div>
                <div class="col-1"></div>
            </div>
            <div class="row py-2 mb-2">
                <div class="col-3">Thesis .doc</div>
                <div class="col-5">:&nbsp;&nbsp;Not uploaded</div>
                <div class="col-2">Download</div>
                <div class="col-1"></div>
            </div>
            <div class="row py-2 mb-2">
                <div class="col-3">Thesis .pdf</div>
                <div class="col-5">:&nbsp;&nbsp;Not uploaded</div>
                <div class="col-2">Download</div>
                <div class="col-1"></div>
            </div>            
        </div>
    </div>
</div>
@endsection