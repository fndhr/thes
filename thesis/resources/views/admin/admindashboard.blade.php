@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row my-5">
        <div class="col-12 text-center">
            <h1>Thesis and Defense Management</h1>
        </div>
    </div>
    <div class="row my-5">
        <div class="col-4">
            <a href="/admin/sessionSet">
                <div class="text-center mx-3">
                    <img src="/assets/image/admin_session.png" width="100" height="100" class="d-inline-block align-top my-4" alt="">
                    <h4>Set Session</h4>
                </div>
            </a>
        </div>
        <div class="col-4">
            <a href="/admin/studentSearch">
                <div class="text-center">
                    <img src="/assets/image/admin_studentsearch.png" width="100" height="100" class="d-inline-block align-top my-4" alt="">
                    <h4>Student Search</h4>
                </div>
            </a>
        </div>
        <div class="col-4">
            <a href="/admin/getDefenseSchedule">
                <div class="text-center mx-3">
                    <img src="/assets/image/admin_searchschedule.png" width="100" height="100" class="d-inline-block align-top my-4" alt="">
                    <h4>Upcoming Defense Schedule Search</h4>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection