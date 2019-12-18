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
            <form  method="POST" action="/admin/register/student">
                @csrf
                <div class="form-group row">
                    <label class="col-3 col-form-label">First Name</label>
                    <input type="text" class="form-control col-9 @error('user_name') is-invalid @enderror" for="first_name" name="first_name" placeholder="example" value="{{old('first_name')}}">
                    @error('first_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label ">Last Name</label>
                    <input type="text" class="form-control col-9 @error('last_name') is-invalid @enderror" for="last_name" name="last_name" placeholder="example" value="{{old('last_name')}}">
                    @error('last_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label">Username</label>
                    <input type="text" class="form-control col-9 @error('username') is-invalid @enderror" for="username" name="username" placeholder="example" value="{{old('username')}}">
                    @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label">Student ID</label>
                    <input type="text" class="form-control col-9 @error('std_id') is-invalid @enderror" for="std_id" name="std_id" placeholder="123456789" value="{{old('std_id')}}">
                    @error('std_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label">Phone Number</label>
                    <input type="text" class="form-control col-9 @error('phone') is-invalid @enderror" for="phone" name="phone" placeholder="081234567890" value="{{old('phone')}}">
                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror                
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label">Email Address</label>
                    <input type="email" class="form-control col-9 @error('email') is-invalid @enderror" for="email" name="email" placeholder="name@example.com"  value="{{old('email')}}">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label">Password</label>
                    <input type="password" class="form-control col-9" for="password" name="password" placeholder="example1234">
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label">Major</label>
                    <select class="form-control col-3" for="major_id" name="major_id">
                        @foreach($majors as $major)
                            <option value="{{$major->major_id}}">{{$major->major_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary px-5 my-4 btnSubmit">Save</button>
                </div>
            </form>
        </div>
    </div>
    <div class="py-3">
        <h2 class="text-center">Student List</h2>
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
                @foreach($students as $student)
                <tr>
                    <td>{{$student->user->first_name}} {{$student->user->last_name}}</td>
                    <td>{{$student->std_id}}</td>
                    <td>{{$student->major->major_name}}</td>
                    <td>{{$student->user->phone ?? 'no phone number'}}</td>
                    <td>{{$student->user->email ?? 'please fill the email'}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection