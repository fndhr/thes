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
            <div class="row py-2 mb-2">
                <div class="col-3">Proposal</div>
                <div class="col-5" for="ThesisProposal" name="ThesisProposal">:&nbsp;&nbsp;{{$student->documentUpload[0]->doc_name}}</div>
                <div class="col-2"><a href="/downloadFile">Download</a></div>
                <div class="col-1">&#10003;</div>
            </div>
            @endif
            @if(count($student->documentUpload)>=2)
            <div class="row py-2 mb-2">
                <div class="col-3">Interim</div>
                <div class="col-5" for="ThesisInterim" name="ThesisInterim">:&nbsp;&nbsp;{{$student->documentUpload[1]->doc_name}}</div>
                <div class="col-2"><a href="/downloadFileInterim">Download</a></div>
                <div class="col-1">&#10003;</div>
            </div>
            @endif
            @if(count($student->documentUpload)>=3)
                <div class="row py-2 mb-2">
                    <div class="col-3">Final Draft</div>
                    <div class="col-5" for="FinalDraft" name="FinalDraft">:&nbsp;&nbsp;{{$student->documentUpload[2]->doc_name}}</div>
                    <div class="col-2"><a href="/downloadFileFinalDraft">Download</a></div>
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
            @endif
            @if(count($student->documentUpload)>=4)
                <div class="row py-2 mb-2">
                    <div class="col-3">Revision</div>
                    <div class="col-5">:&nbsp;&nbsp;Not uploaded</div>
                    <div class="col-2">Download</div>
                    <div class="col-1"></div>
                </div>
            @endif
            @if(count($student->documentUpload)>=5)
                <div class="row py-2 mb-2">
                    <div class="col-3">Thesis .zip</div>
                    <div class="col-5">:&nbsp;&nbsp;Not uploaded</div>
                    <div class="col-2">Download</div>
                    <div class="col-1"></div>
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