@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row my-5">
        <div class="col-12 text-center">
            <h1>Upcoming Defense Schedule</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-11">
            <div class="row py-2">
                <div class="col-3">Student</div>
                <div class="col-9">:&nbsp;&nbsp;{{$student->user->first_name}} {{$student->user->last_name}}</div>
            </div>
            <div class="row py-2">
                <div class="col-3">Title</div>
                <div class="col-9">:&nbsp;&nbsp;{{$student->title->title_name}}</div>
            </div>
            <div class="row py-2">
                <div class="col-3">Advisor</div>
                <div class="col-9">:&nbsp;&nbsp;{{$student->lecturer->user->first_name}} {{$student->lecturer->user->last_name}}</div>
            </div>
            <div class="row py-2">
                <div class="col-3">Date</div>
                <div class="col-9">:&nbsp;&nbsp;{{$student->date}}</div>
            </div>
            <div class="row py-2">
                <div class="col-3">Time</div>
                <div class="col-9">:&nbsp;&nbsp;{{$student->time}}</div>
            </div>
            <div class="row py-2">
                <div class="col-3">Room</div>
                <div class="col-9">:&nbsp;&nbsp;{{$student->defense->room}}</div>
            </div>
            <div class="row py-2">
                <div class="col-3">Chairman</div>
                <div class="col-9">:&nbsp;&nbsp;{{$student->defense->chairman_name->user->first_name}} {{$student->defense->chairman_name->user->last_name}}</div>
            </div>
            <div class="row py-2">
                <div class="col-3">Examiner</div>
                <div class="col-9">:&nbsp;&nbsp;{{$student->defense->examiner_name->user->first_name}} {{$student->defense->examiner_name->user->last_name}}</div>
            </div>
            <div class="text-center">
                <a href="/lecturer/defensescoring/{{$student->std_id}}"><button type="submit" class="btn btn-primary px-5 my-4">Live Scoring</button></a>
            </div>
        </div>
    </div>
</div>
@endsection