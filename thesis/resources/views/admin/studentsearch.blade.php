@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row my-5">
        <div class="col-12 text-center">
            <h1>Student Search</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-11">
            <form method="POST" action="studentSearch">
            {{ csrf_field() }}
                <div class="form-group row">
                    <label class="col-3 col-form-label inputRequired">Student</label>
                    <input type="text" class="form-control col-9" for="std_name" name="std_name" placeholder="Input Student Name or ID">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary px-5 my-4 btnSubmit">Search</button>
                </div>
            </form>
            @if(isset($students))
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th scope="col">Student ID</th>
                            <th scope="col">Student</th>
                            <th scope="col">Status</th>
                            <th scope="col">Advisor</th>
                        </tr>
                    </thead>
                    
                    @if(count($students) > 0)
                    <tbody>
                        @foreach($students as $student)
                        <tr>
                            <td>{{$student->std_id}}</td>
                            <td><a href="/admin/studentDetail/{{$student->std_id}}">{{$student->user->first_name}} {{$student->user->last_name}}</a></td>
                            <td></td>
                            <td>{{$student->lecturer ? $student->lecturer->user->first_name.' '.$student->lecturer->user->last_name : '-'}}</td>                        
                        </tr>
                        @endforeach
                    </tbody>
                    @else
                    <tbody>
                        <tr>
                            <td colspan="4" class="text-center">Records Not Found</td>
                        </tr>
                    </tbody>
                    @endif
                </table>
            @endif
        </div>
    </div>
</div>
@endsection