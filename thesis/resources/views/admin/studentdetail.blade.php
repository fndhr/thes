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
            @if(!is_null($student->title_id))
            <div class="row py-2 mb-2">
                <div class="col-3">Title</div>
                <div class="col-7">:&nbsp;&nbsp;Restourant Management System for Bubble Tea Stall</div>
                <div class="col-1">&#10003;</div>
            </div>
            @endif
            @if(count($student->proposedTitle)>0)
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
                            <tr>
                                <td>{{$num}}.</td>
                                <td>{{$title->title_name}}</td>
                                <td><span class="text-success">YES</span>&emsp;<span class="text-danger">NO</span></td>
                                @php($num++)
                            </tr>
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
            @if(count($student->proposedAdvisor)>0)
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
                            <tr>
                                <td>{{$num}}.</td>
                                <td>{{$advisor->lecturer->user->first_name.' '.$advisor->lecturer->user->last_name}}</td>
                                <td>
                                    <span class="text-success" onclick="event.preventDefault(); document.getElementById('button-yes-advisor').submit();">YES</span>&emsp;
                                    <span class="text-danger" onclick="event.preventDefault(); document.getElementById('button-no-advisor').submit();">NO</span></td>
                                <form id="button-yes-advisor" action="/admin/approve/advisor" method="POST" style="display: none;">@csrf<input for="advisor" name="advisor" value="{{$advisor->advisor_id}}" style="display:none"><input for="std" name="std" value="{{$student->std_id}}" style="display:none"></form>
                                <form id="button-no-advisor" action="/admin/disapprove/advisor" method="POST" style="display: none;">@csrf<input for="advisor" name="advisor" value="{{$advisor->advisor_id}}" style="display:none"><input for="std" name="std" value="{{$student->std_id}}" style="display:none"></form>
                            </tr>
                            @php($num++)
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
            <div class="row py-2 mb-2">
                <div class="col-3">Proposal</div>
                <div class="col-5">:&nbsp;&nbsp;Fiqa Nadhira - Proposal.pdf</div>
                <div class="col-2"><a href="">Download</a></div>
                <div class="col-1">&#10003;</div>
            </div>
            <div class="row py-2 mb-2">
                <div class="col-3">Inteirm</div>
                <div class="col-5">:&nbsp;&nbsp;Fiqa Nadhira - Interim.pdf</div>
                <div class="col-2"><a href="">Download</a></div>
                <div class="col-1">&#10003;</div>
            </div>
            <div class="row py-2 mb-2">
                <div class="col-3">Final Draft</div>
                <div class="col-5">:&nbsp;&nbsp;Not uploaded</div>
                <div class="col-2">Download</div>
                <div class="col-1"></div>
            </div>
            <div class="row py-2 mb-2">
                <div class="col-3">Defense Date</div>
                <div class="col-5">:&nbsp;&nbsp;Not set</div>
                <div class="col-2"><a href="">View</a>&nbsp;|&nbsp;<a href="">Set</a></div>
                <div class="col-1"></div>
            </div>
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