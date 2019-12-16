@extends('layouts.app')

@section('content')
    <div class="container bg-light my-5 px-5" style="border-radius: 10px; box-shadow: 3px 3px 10px grey;">
        <div class="row py-4">
            <div class="col-4">
                <h1>User Registration</h1>
            </div>
            <div class="col-2">
                <select class="custom-select mt-2 type" id="inputGroupSelect04" aria-label="Example select with button addon">
                    <option selected>Choose...</option>
                    <option value="lecturer">Lecturer</option>
                    <option value="student">Student</option>
                </select>
            </div>
        </div>
        <div class="entry entryLecturer">
            <form method="POST" action="/register/lecturer">
                @csrf
                <div class="form-group row">
                    <label class="col-3 col-form-label">First Name</label>
                    <input type="text" class="form-control col-9" for="first_name" placeholder="example">
                    @error('first_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label">Last Name</label>
                    <input type="text" class="form-control col-9" for="last_name" placeholder="example">
                    @error('last_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label">Username</label>
                    <input type="text" class="form-control col-9" for="user_name" placeholder="example">
                    @error('first_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label">Lecturer ID</label>
                    <input type="text" class="form-control col-9" for="lec_id" placeholder="123456789">
                    @error('first_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label">Role</label>
                    <div class="col-9 pt-2 pl-0" id="roleLecturer">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" for="isAdv" name="isAdv" id="advisor" value="option1">
                            <label class="form-check-label" for="advisor">Advisor</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" for="isExm" name="isExm" id="examiner" value="option2">
                            <label class="form-check-label" for="examiner">Examiner</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label">Phone Number</label>
                    <input type="text" class="form-control col-9" for="phone" placeholder="081234567890">
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label">Email Address</label>
                    <input type="email" class="form-control col-9" for="email" placeholder="name@example.com">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary px-5 my-3 btnSubmit">Save</button>
                </div>
            </form>
            <div class="dataTable py-3">
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
                        <tr>
                        <td>Fiqa Nadhira</td>
                        <td>001201600001</td>
                        <td>Information System</td>
                        <td>081234567890</td>
                        <td>fiqa.nadhira@gmail.com</td>
                        </tr>
                        <tr>
                            <td>Muhammad Fadrean</td>
                            <td>001201600002</td>
                            <td>Information System</td>
                            <td>081234567890</td>
                            <td>muhammad.fadrean@gmail.com</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="entry entryStudent">
            <form  method="POST" action="/register/student">
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
                    <label class="col-3 col-form-label">Last Name</label>
                    <input type="text" class="form-control col-9" for="last_name" name="last_name" placeholder="example">
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
                    <input type="text" class="form-control col-9" for="std_id" name="std_id" placeholder="123456789">
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label">Phone Number</label>
                    <input type="text" class="form-control col-9" for="phone" name="phone" placeholder="081234567890">
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label">Email Address</label>
                    <input type="email" class="form-control col-9" for="email" name="email" placeholder="name@example.com">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label">Password</label>
                    <input type="password" class="form-control col-9" for="password" name="password" placeholder="name@example.com">
                </div>
                <div class="form-group row">
                    <label class="col-3 col-form-label">Major</label>
                    <select class="form-control col-3" for="major_id" name="major_id">
                        <option selected>Choose...</option>
                        <option value="1">Information System</option>
                        <option value="2">Information Technology</option>
                        <option value="3">Visual Design Graphic</option>
                    </select>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary px-5 my-3 btnSubmit">Save</button>
                </div>
            </form>
            <div class="dataTable py-3">
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
                        <tr>
                        <td>Fiqa Nadhira</td>
                        <td>001201600001</td>
                        <td>Information System</td>
                        <td>081234567890</td>
                        <td>fiqa.nadhira@gmail.com</td>
                        </tr>
                        <tr>
                            <td>Muhammad Fadrean</td>
                            <td>001201600002</td>
                            <td>Information System</td>
                            <td>081234567890</td>
                            <td>muhammad.fadrean@gmail.com</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endsection