@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row my-5">
        <div class="col-12 text-center">
            <h1>Upcoming Defense Schedule Search</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-11">
            <form method="POST" action="">
                <div class="form-group row">
                    <label class="col-3 col-form-label inputRequired">Student*</label>
                    <input type="text" class="form-control col-9" for="std_id" placeholder="Input Student Name or ID">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary px-5 my-4 btnSubmit">Search</button>
                </div>
            </form>
            <table class="table table-bordered table-hover">
                <thead class="thead-dark text-center">
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Student ID</th>
                        <th scope="col">Student Name</th>
                        <th scope="col">Advisor</th>
                        <th scope="col">Date</th>
                    </tr>
                </thead>
                <tbody>
                @if(count($defenses)>0)
                        @php($num = 1)
                        @foreach($defenses as $defense)
                        <tr>
                            <td>{{$num}}.</td>
                            <td>{{$defense->student->std_id}}</td>
                            <td><a href="/lecturer/getDefenseScheduleDetail/{{$defense->student->std_id}}">{{$defense->student->user->first_name}} {{$defense->student->user->last_name}}</a></td>
                            <td>{{$defense->student->lecturer->user->first_name}} {{$defense->student->lecturer->user->last_name}}</td>
                            <td>{{$defense->date}}</td>
                        </tr>
                        @php($num++)
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" class="text-center">Records Not Found</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection