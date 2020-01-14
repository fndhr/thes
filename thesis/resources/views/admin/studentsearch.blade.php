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
                    <label class="col-2 col-form-label">Search</label>
                    <label class="col-1 col-form-label">:&nbsp;&nbsp;</label>
                    <input type="text" class="form-control col-9" for="std_name" name="std_name" placeholder="Input Student Name or ID">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-pill px-5 my-4 btnSubmit">Search</button>
                </div>
            </form>
            @if(isset($students))
                <table class="table table-bordered table-sm table-hover mt-5">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Student ID</th>
                            <th scope="col">Student Name</th>
                            <th scope="col">Status</th>
                            <th scope="col">Advisor</th>
                        </tr>
                    </thead>
                    
                    @if(count($students) > 0)
                    <tbody>
                        @php($num = 1)
                        @foreach($students as $student)
                        <tr>
                            <td>{{$num}}.</td>
                            <td>{{$student->std_id}}</td>
                            <td><a href="/admin/studentDetail/{{$student->std_id}}">{{$student->user->first_name}} {{$student->user->last_name}}</a></td>
                            <td></td>
                            <td>{{$student->lecturer ? $student->lecturer->user->first_name.' '.$student->lecturer->user->last_name : '-'}}</td>                        
                        </tr>
                        @php($num++)
                        @endforeach
                    </tbody>
                    @else
                    <tbody>
                        <tr>
                            <td colspan="5" class="text-center">Records Not Found</td>
                        </tr>
                    </tbody>
                    @endif
                </table>
            @endif
        </div>
    </div>
</div>
@endsection