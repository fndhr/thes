@extends('layouts.app')

@section('content')
<div class="container bg-light my-5 px-5 py-4" style="border-radius: 10px; box-shadow: 3px 3px 10px grey;">
    <div class="row my-4">
        <div class="col-4">
            <h1>Your Progress</h1>
        </div>
    </div>
    <div class="row py-2">
        <div class="col-3">
        Title
        </div>
        <div class="col-9">
        :&nbsp;&nbsp;Thesis's Title
        </div>
    </div>
    <div class="row py-2">
        <div class="col-3">
        Advisor
        </div>
        <div class="col-9">
        :&nbsp;&nbsp;Advisor Name
        </div>
    </div>
    <div class="row py-2">
        <div class="col-3">
        Status
        </div>
        <div class="col-9">
        :&nbsp;&nbsp;Status Progress
        </div>
    </div>
    <div class="row py-2">
        <div class="col-3">
        Defense
        </div>
        <div class="col-9">
        :&nbsp;&nbsp;Date not set
        </div>
    </div>
</div>
@endsection