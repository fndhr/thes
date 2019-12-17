@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row my-5">
        <div class="col-12 text-center">
            <h1>Thesis and Defense Management</h1>
        </div>
    </div>
    <div class="row my-5">
        <div class="col-3">
            <a href="/admin/sessionSet">
                <div class="text-center mx-3">
                    <img src="https://cdn2.iconfinder.com/data/icons/pittogrammi/142/10-512.png" width="100" height="100" class="d-inline-block align-top my-4" alt="">
                    <h4>Set Session</h4>
                </div>
            </a>
        </div>
        <div class="col-3">
            <a href="/admin/studentProposal">
                <div class="text-center">
                    <img src="https://cdn0.iconfinder.com/data/icons/faticons-2/30/approve3-512.png" width="100" height="100" class="d-inline-block align-top my-4" alt="">
                    <h4>Student Title and Advisor Proposal</h4>
                </div>
            </a>
        </div>
        <div class="col-3">
            <a href="/admin/setDefenseSchedule">
                <div class="text-center mx-3">
                    <img src="https://cdn2.iconfinder.com/data/icons/office-38/24/office-15-512.png" width="100" height="100" class="d-inline-block align-top my-4" alt="">
                    <h4>Set Defense Schedule</h4>
                </div>
            </a>
        </div>
        <div class="col-3">
            <a href="/admin/getDefenseSchedule">
                <div class="text-center mx-3">
                    <img src="https://cdn2.iconfinder.com/data/icons/flat-ui-icons-24-px/24/menu-24-512.png" width="100" height="100" class="d-inline-block align-top my-4" alt="">
                    <h4>Upcoming Defense Schedule</h4>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection