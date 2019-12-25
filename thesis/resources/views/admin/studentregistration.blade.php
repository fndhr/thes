@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row my-5">
        <div class="col-12 text-center">
            <h1>User Registration Student</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-11">
            <form  method="POST" action="register/student" class="submitForm">
                @csrf
                <div class="form-group row">
                    <label class="col-3 col-form-label inputRequired">First Name*</label>
                    <input type="text" class="form-control col-9 @error('first_name') is-invalid @enderror" for="first_name" name="first_name" placeholder="Please Input Your First Name" value="{{old('first_name')}}">
                    @error('first_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label inputRequired">Last Name*</label>
                    <input type="text" class="form-control col-9 @error('last_name') is-invalid @enderror" for="last_name" name="last_name" placeholder="Please Input Your Last Name" value="{{old('last_name')}}">
                    @error('last_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label inputRequired">Student ID*</label>
                    <input type="number" class="form-control col-9 @error('std_id') is-invalid @enderror" for="std_id" name="std_id" placeholder="Please Input Your Student ID" value="{{old('std_id')}}">
                    @error('std_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label">Major</label>
                    <select class="form-control col-3" for="major_id" name="major_id">
                        @foreach($majors as $major)
                            <option value="{{$major->major_id}}">{{$major->major_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label">Phone Number</label>
                    <input type="number" class="form-control col-9 @error('phone') is-invalid @enderror" for="phone" name="phone" placeholder="Please Input Your Phone Number (ex:08xx)" value="{{old('phone')}}">
                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror                
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label inputRequired">Email Address*</label>
                    <input type="email" class="form-control col-9 @error('email') is-invalid @enderror" for="email" name="email" placeholder="Please Input Your Email Address"  value="{{old('email')}}">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label inputRequired">Session*</label>
                    <select class="form-control col-3 @error('session_id') is-invalid @enderror" name="session_id">
                        <option value="">Choose...</option>
                        @foreach($sessions as $session)
                            <option value="{{$session->session_id}}">{{$session->session_id}}</option>
                        @endforeach
                    </select>
                    @error('session_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror   
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success px-5 my-4 btnSubmit">Save</button>
                </div>
            </form>
        </div>
    </div>
    <div class="py-3">
        <h2 class="text-center">List of Student</h2>
        <table class="table table-bordered table-hover">
            <thead class="thead-dark text-center">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Student ID</th>
                    <th scope="col">Major</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Email</th>
                </tr>
            </thead>
            <tbody>
                @if(count($students)>0)
                @foreach($students as $student)
                <tr>
                    <td>{{$student->user->first_name}} {{$student->user->last_name}}</td>
                    <td>{{$student->std_id}}</td>
                    <td>{{$student->major->major_name}}</td>
                    <td>{{$student->user->phone ?? 'no phone number'}}</td>
                    <td>{{$student->user->email ?? 'please fill the email'}}</td>
                </tr>
                @endforeach
                @else
                    <tr>
                        <td colspan="5" class="text-center">Records Not Found</td>
                    </tr>
                @endif
            </tbody>
        </table>

        {{$students->links()}}
    </div>
</div>
@endsection